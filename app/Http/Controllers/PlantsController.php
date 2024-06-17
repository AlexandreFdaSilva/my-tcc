<?php

namespace App\Http\Controllers;

use App\Models\Molecule;
use App\Models\Plant;
use App\Models\Plant_Molecule;
use App\Models\Reference;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PlantsController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $plants = Plant::orderBy('species', 'asc')->paginate(20);
        // $plants = Plant::search(request(key: 'search'))->paginate(20); // With search

        $user = User::find(Auth::user()->id);
        $userIsAdmin = $user->isAdministrator();

        return view('plants.index', ['plants' => $plants, 'admin' => $userIsAdmin]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $molecules = Molecule::all();

        return view('plants.create', ['molecules' => $molecules]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $moleculesAndReferencesValidator = [];
        $plantValidator = [
            'species' => 'required|string|max:255',
            'synonyms' => 'required|string|max:255',
            'material' => 'required|string|max:255',
            'geolocation' => 'required|string|max:255',
            'image' => 'nullable|mimes:jpg,png,jpeg|max:10240',
        ];
        $references = [];
        $molecules = [];
        $referencesData = [];

        // For validate the dynamics references and molecules...
        foreach ($request->all() as $key => $value) {
            if (preg_match('/^(selected_molecules|reference_title|reference_author|reference_doi|reference_pmid)-\d+$/', $key)) {
                if (preg_match('/^selected_molecules/', $key)) {
                    $molecules[$key] = $value;
                    $moleculesAndReferencesValidator[$key] = 'required|array|min:0';
                } else {
                    $references[$key] = $value;
                    $moleculesAndReferencesValidator[$key] = 'required|string|max:255';
                }
            }
        }

        // Validate all the data (Plant + Dynamic references/molecules)
        $validationRules = array_merge($plantValidator, $moleculesAndReferencesValidator);
        $request->validate($validationRules);

        // Create the Plant
        try {
            $plant = Plant::create($request->only(array_keys($plantValidator)));

            if ($request->image) {
                try {
                    $file = $request->file('image');

                    $path = 'plants/' . $plant->id;

                    $storage = $file->store($path, 's3');

                    $storagePath = Storage::cloud()->url($storage);

                    $plant = Plant::findOrFail($plant->id);

                    $plant->update(['image_path' => $storagePath]);
                } catch (\Exception $e) {
                    return redirect()->route('plants.index')->with('error', 'Failed to upload image to plant');
                }
            }
        } catch (\Throwable $th) {
            throw new Exception("Error while trying to create new plant");
        }

        // Separete the references in an array of 'sections'
        if ($references) {
            // Iterate through the references array to extract reference information
            for ($i = 0; isset($references["reference_title-$i"]); $i++) {
                // Prepare reference data for each index
                $univali = $request->has("reference_univali-$i") ? true : false;
                $referenceData = [
                    'title' => $references["reference_title-$i"],
                    'author' => $references["reference_author-$i"],
                    'doi' => $references["reference_doi-$i"],
                    'pmid' => $references["reference_pmid-$i"],
                    'univali' => $univali,
                ];

                // Add reference data to the array
                $referencesData[] = $referenceData;
            }

            // Create the reference
            foreach ($referencesData as $referenceData) {
                try {
                    $createdReferences[] = Reference::create($referenceData);
                } catch (\Throwable $th) {
                    return response()->json(['error' => 'Failed to create plant'], 500);
                }

                // Create the PlantReference
                $moleculesId = [];

                // Separate the molecules ID by sections
                foreach ($molecules as $selectedMolecules) {
                    $ids = [];
                    foreach ($selectedMolecules as $molecule) {
                        $parts = explode("_", $molecule);
                        $ids[] = $parts[0];
                    }
                    array_push($moleculesId, $ids);
                }
            }

            // Need to foreach the references, because each molecule create a new row in the DB plant_molecule
            try {
                $index = 0;

                if (isset($createdReferences)) {
                    foreach ($createdReferences as $reference) {
                        if (isset($moleculesId[$index])) {
                            foreach ($moleculesId[$index] as $moleculesIndex) {
                                Plant_Molecule::create([
                                    'plant_id' => $plant->id,
                                    'molecule_id' => $moleculesIndex,
                                    'reference_id' => $reference->id,
                                ]);
                            }
                        } else {
                            Plant_Molecule::create([
                                'plant_id' => $plant->id,
                                'reference_id' => $reference->id,
                            ]);
                        }
                        $index++;
                    }
                }
            } catch (\Throwable $th) {
                return response()->json(['error' => 'Failed to create molecule_plant'], 500);
            }
        }

        return redirect()->route('plants.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plant $plant) {
        try {
            $plant_molecule = Plant_Molecule::where('plant_id', $plant->id)->get();

            // Get References
            $referencesId = $plant_molecule->pluck('reference_id')->toArray();
            $references = Reference::whereIn('id', $referencesId)->distinct()->get();

            // How each reference is connected to specifics molecules, i need to retrive this like the section in the store...
            $sections = []; // Each section have N molecules + 1 Reference. Each section => [Reference, [N Molecules]]
            foreach ($references as $reference) {
                $filteredPlantMolecules = $plant_molecule->where('reference_id', $reference->id)->pluck('molecule_id')->toArray();
                $molecules = Molecule::whereIn('id', $filteredPlantMolecules)->distinct()->get();
                $section = [$reference, $molecules];
                array_push($sections, $section);
            }

            $user = User::find(Auth::user()->id);
            $userIsAdmin = $user->isAdministrator();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Failed to edit plant'], 500);
        }

        return view('plants.show', [
            'plant' => $plant,
            'sections' => $sections,
            'admin' => $userIsAdmin,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plant $plant) {
        try {
            $plant_molecule = Plant_Molecule::where('plant_id', $plant->id)->get();
            $molecules = Molecule::all();

            // Get References
            $referencesId = $plant_molecule->pluck('reference_id')->toArray();
            $references = Reference::whereIn('id', $referencesId)->distinct()->get();

            // How each reference is connected to specifics molecules, i need to retrive this like the section in the store...
            $sections = []; // Each section have N molecules + 1 Reference. Each section => [Reference, [N Molecules]]
            foreach ($references as $reference) {
                $filteredPlantMolecules = $plant_molecule->where('reference_id', $reference->id)->pluck('molecule_id')->toArray();
                $moleculesFromReference = Molecule::whereIn('id', $filteredPlantMolecules)->distinct()->get();
                $section = [$reference, $moleculesFromReference];
                array_push($sections, $section);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Failed to edit plant'], 500);
        }
        return view('plants.edit', ['plant' => $plant, 'sections' => $sections, 'allMolecules' => $molecules]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plant $plant) {
        $plant_molecule = Plant_Molecule::where('plant_id', $plant->id)->get();
        // Get References
        $referencesId = $plant_molecule->pluck('reference_id')->toArray();
        $originalReferences = Reference::whereIn('id', $referencesId)->distinct()->get();

        $plantValidator = [
            'species' => 'string|max:255',
            'synonyms' => 'nullable|string|max:255',
            'material' => 'nullable|string|max:255',
            'geolocation' => 'nullable|string|max:255',
            'image' => 'nullable|mimes:jpg,png,jpeg|max:10240',
        ];

        $moleculesAndReferencesValidator = [];
        $newReferences = [];
        $newMolecules = [];
        // For validate the dynamics referencesValidator and molecules...
        foreach ($request->all() as $key => $value) {
            if (preg_match('/^(selected_molecules|reference_title|reference_author|reference_doi|reference_pmid)-\d+$/', $key)) {
                if (preg_match('/^selected_molecules/', $key)) {
                    $newMolecules[$key] = $value;
                    $moleculesAndReferencesValidator[$key] = 'required|array|min:1';
                } else {
                    $newReferences[$key] = $value;
                    $moleculesAndReferencesValidator[$key] = 'required|string|max:255';
                }
            }
        }

        // Validate all the data (Plant + Dynamic references/molecules)
        $validationRules = array_merge($plantValidator, $moleculesAndReferencesValidator);
        $request->validate($validationRules);

        // Check if modifided the originals references/original molecules
        $referencePattern = '/^reference_([^_]+)-(\d+)-original$/i';
        $moleculePattern = '/^selected_molecules-(\d+)-original$/i';
        $modifidedSections = [];

        foreach ($request->all() as $key => $value) {
            if (preg_match($referencePattern, $key, $matches)) {
                $attribute = $matches[1]; // Extract the attribute
                $index = intval($matches[2]); // Extract the index from the key
                $modifidedSections[$index]['reference'][$attribute] = $value; // Use the index and attribute to place data in the correct position
            } elseif (preg_match($moleculePattern, $key, $matches)) {
                $index = $matches[1];
                $modifidedSections[$index]['molecules'] = $value;
            }
        };

        // Update the references
        $removedReferences = [];
        if ($modifidedSections === null) {
            // If $modifidedSections is null, all references from $originalReferences are removed
            $removedReferences = $originalReferences;
        } else {
            foreach ($originalReferences as $reference) {
                $found = false;
                $index = 0;
                foreach ($modifidedSections as $modifidedSection) {
                    $modifidedReference = $modifidedSection['reference'];
                    if ($reference['id'] == $modifidedReference['id']) {
                        $found = true;
                        break; // No need to continue searching
                    }
                }
                if (!$found) {
                    // If the reference is not found in $modifidedSections, add it to $removedReferences
                    $removedReferences[] = $reference;
                    $index++;
                }
            }
        }

        // 1. If have removed original references
        foreach ($removedReferences as $removedReference) {
            try {
                Plant_Molecule::where('reference_id', $removedReference['id'])->delete();
                Reference::destroy($removedReference['id']);
            } catch (\Throwable $th) {
                return response()->json(['error' => 'Failed to remove plant_molecule / reference'], 500);
            }
        }

        // 2. If we have modifided the original references / molecules
        foreach ($modifidedSections as $modifidedSection) {
            $modifidedMolecules = isset($modifidedSection['molecules']) ? $modifidedSection['molecules'] : [];
            $modifidedReference = $modifidedSection['reference'];

            // 1. Update the reference
            $reference = Reference::find($modifidedReference['id']);

            $reference->update([
                'title' => $modifidedReference['title'],
                'author' => $modifidedReference['author'],
                'univali' => isset($modifidedReference['univali']) ? 1 : 0, // Convert string to boolean, // Convert string to boolean
                'doi' => $modifidedReference['doi'],
                'pmid' => $modifidedReference['pmid']
            ]);

            // 2. Update the plant_molecule
            $plant_molecule = Plant_Molecule::where([
                ['plant_id', $plant->id],
                ['reference_id', $reference->id]
            ])->get();

            // Create an array of original molecules ID
            $originalMoleculesId = array_column(json_decode($plant_molecule), 'molecule_id');

            // Create an array of modifideds molecules ID
            $moleculeIdsModifideds = [];
            foreach ($modifidedMolecules as $modifidedMolecule) {
                $parts = explode('_', $modifidedMolecule);
                $moleculeIdsModifideds[] = (int)$parts[0];
            }
            $moleculesDeleted = array_diff($originalMoleculesId, $moleculeIdsModifideds);
            $moleculesAdded = array_diff($moleculeIdsModifideds, $originalMoleculesId);

            // Remove the deleted molecules, execpt for the last one (Just remove the molecule, but keeps the reference)
            $lastMolecule = end($moleculesDeleted);
            foreach ($moleculesDeleted as $moleculeToDelete) {
                if ($moleculeToDelete !== $lastMolecule) {
                    Plant_Molecule::where([
                        ['molecule_id', $moleculeToDelete],
                        ['reference_id', $reference->id],
                        ['plant_id', $plant->id],
                    ])->delete();
                } else {
                    Plant_Molecule::where([
                        ['molecule_id', $moleculeToDelete],
                        ['reference_id', $reference->id],
                        ['plant_id', $plant->id],
                    ])->update([
                        'molecule_id' => null,
                    ]);
                }
            }

            // Add the new molecules
            // First, check if have some plant_molecule with null molecule to update to some molecule.
            $plantWithNullMolecule = Plant_Molecule::where([
                ['reference_id', $reference->id],
                ['plant_id', $plant->id],
            ])->first();

            $firstMoleculeToAdd = reset($moleculesAdded);
            foreach ($moleculesAdded as $moleculeToAdd) {
                if ($moleculeToAdd === $firstMoleculeToAdd && $plantWithNullMolecule) {
                    $plantWithNullMolecule->update(['molecule_id' => $moleculeToAdd]);
                } else {
                    Plant_Molecule::create([
                        'molecule_id' => $moleculeToAdd,
                        'reference_id' => $reference->id,
                        'plant_id' => $plant->id,
                    ]);
                }
            }
        }

        // 3. If we created new references
        // Separete the references in an array of 'sections'
        if ($newReferences) {
            $start = $originalReferences->count() - count($removedReferences);
            // Iterate through the references array to extract reference information
            for ($i = $start; isset($newReferences["reference_title-$i"]); $i++) {
                // Prepare reference data for each index
                $univali = $request->has("reference_univali-$i") ? true : false;
                $referenceData = [
                    'title' => $newReferences["reference_title-$i"],
                    'author' => $newReferences["reference_author-$i"],
                    'doi' => $newReferences["reference_doi-$i"],
                    'pmid' => $newReferences["reference_pmid-$i"],
                    'univali' => $univali,
                ];

                // Add reference data to the array
                $referencesData[] = $referenceData;
            }

            // Create the reference
            foreach ($referencesData as $referenceData) {
                try {
                    $createdReferences[] = Reference::create($referenceData);
                } catch (\Throwable $th) {
                    return response()->json(['error' => 'Failed to create plant'], 500);
                }
            }

            // Create the PlantReference
            $moleculesId = [];

            // Separate the molecules ID by sections
            foreach ($newMolecules as $selectedMolecules) {
                $ids = [];
                foreach ($selectedMolecules as $molecule) {
                    $parts = explode("_", $molecule);
                    $ids[] = $parts[0];
                }
                array_push($moleculesId, $ids);
            }

            // Need to foreach the references, because each molecule create a new row in the DB plant_molecule
            try {
                $index = 0;

                if (isset($createdReferences)) {
                    foreach ($createdReferences as $reference) {
                        if (isset($moleculesId[$index])) {
                            foreach ($moleculesId[$index] as $moleculesIndex) {
                                Plant_Molecule::create([
                                    'plant_id' => $plant->id,
                                    'molecule_id' => $moleculesIndex,
                                    'reference_id' => $reference->id,
                                ]);
                            }
                        } else {
                            Plant_Molecule::create([
                                'plant_id' => $plant->id,
                                'reference_id' => $reference->id,
                            ]);
                        }
                        $index++;
                    }
                }
            } catch (\Throwable $th) {
                return response()->json(['error' => 'Failed to create molecule_plant'], 500);
            }
        }

        // Update the plant information
        $plant = Plant::find($plant->id);
        if ($request->image) {
            try {
                $file = $request->file(key: 'image');
                $storage = $file->store(path: 'plants/' . $plant->id, options: 's3');
                $storagePath = Storage::cloud()->url($storage);
                try {
                    $plant->update([
                        'species' => $request->input('species'),
                        'synonyms' => $request->input('synonyms'),
                        'material' => $request->input('material'),
                        'geolocation' => $request->input('geolocation'),
                        'image_path' => $storagePath
                    ],);
                } catch (\Exception $e) {
                    return redirect()->route('plants.index')->with('error', 'Failed to update plant');
                }
            } catch (\Exception $e) {
                return redirect()->route('plants.index')->with('error', 'Failed to upload image');
            }
        } else {
            try {
                $plant->update([
                    'species' => $request->input('species'),
                    'synonyms' => $request->input('synonyms'),
                    'material' => $request->input('material'),
                    'geolocation' => $request->input('geolocation'),
                ]);
            } catch (\Exception $e) {
                return redirect()->route('plants.index')->with('error', 'Failed to update plant');
            }
        }
        return redirect()->route('plants.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plant $plant) {
        try {
            $idReferences = Plant_Molecule::where('plant_id', $plant->id)->pluck('reference_id');
            Plant_Molecule::where('plant_id', $plant->id)->delete();
            Reference::whereIn('id', $idReferences)->delete();
            $plant->delete();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Failed to delete plant'], 500);
        }
        return redirect()->route('plants.index');
    }
}
