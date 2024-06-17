<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Molecule;
use App\Models\Plant_Molecule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class MoleculeController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $mol = Molecule::paginate(20);
        $user = User::find(Auth::user()->id);
        $userIsAdmin = $user->isAdministrator();

        return view('molecules.index', [
            'molecules' => $mol,
            'admin' => $userIsAdmin,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('molecules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse {
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'class' => 'nullable|string|max:255',
            'stereochemistry' => 'nullable|string|max:255',
            'chemical_similarity' => 'nullable|string|max:255',
            'formula' => 'nullable|string|max:255',
            'smiles' => 'nullable|string|max:255',
            'inchi' => 'nullable|string|max:255',
            'methodology' => 'nullable|string|max:255',
            'iupac' => 'nullable|string|max:255',
            'molecular_weight' => 'nullable|string|max:255',
            'x_log_p' => 'nullable|string|max:255',
            'h_bond_donor_count' => 'nullable|string|max:255',
            'h_bond_acceptor_count' => 'nullable|string|max:255',
            'rotatable_bond_count' => 'nullable|string|max:255',
            'exact_mass' => 'nullable|string|max:255',
            'monoisotopic_mass' => 'nullable|string|max:255',
            'tpsa' => 'nullable|string|max:255',
            'heavy_atom_count' => 'nullable|string|max:255',
            'charge' => 'nullable|string|max:255',
            'complexity' => 'nullable|string|max:255',
            'isotope_atom_count' => 'nullable|string|max:255',
            'defined_atom_stereo_count' => 'nullable|string|max:255',
            'undefined_atom_stereo_count' => 'nullable|string|max:255',
            'defined_bond_stereo_count' => 'nullable|string|max:255',
            'undefined_bond_stereo_count' => 'nullable|string|max:255',
            'covalent_unit_count' => 'nullable|string|max:255',
            'status' => 'string|max:255',
            'notes' => 'nullable|string|max:2550'
        ]);

        try {
            Molecule::create($validatedData);
        } catch (\Exception $e) {
            return redirect()->route('molecules.index')->with('error',  'Failed to create molecule');
        }
        return redirect()->route('molecules.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Molecule $molecule) {
        $user = User::find(Auth::user()->id);
        $userIsAdmin = $user->isAdministrator();

        return view('molecules.show', [
            'molecule' => $molecule,
            'admin' => $userIsAdmin,
        ]);
    }

    public function generateSVG(Molecule $molecule) {
        $command = ["py", "../rdkit/main.py", "--inchi", $molecule->inchi, "--smiles", $molecule->smiles];
        $process = new Process($command, null, [
            'SYSTEMROOT' => getenv('SYSTEMROOT'),
            'PATH' => getenv("PATH")
        ]);
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        $output = $process->getOutput();
        $isSvg = strpos($output, '<svg') !== false;
        if (!$isSvg) {
            $filePath = public_path('assets/images/placeholder.svg');
            $image = File::get($filePath);
        } else {
            $image = $output;
        }

        return response($image)->header('Content-Type', 'image/svg+xml');
    }

    public function generateImage(Molecule $molecule) {
        $url = "https://pubchem.ncbi.nlm.nih.gov/rest/pug/compound/name/{$molecule->name}/PNG";
        $response = Http::get($url);

        try {
            $response = Http::get($url);

            if ($response->successful()) {
                $imageContent = $response->body();

                return response($imageContent)->header('Content-Type', 'image/png');
            } else {
                return $this->generateSVG($molecule);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching the image'], 500);
        }
    }

    public function pubchemSearch(string $moleculeName) {
        try {
            $cidUrl = "https://pubchem.ncbi.nlm.nih.gov/rest/pug/compound/name/{$moleculeName}/cids/TXT";
            $response = Http::get($cidUrl);
            $cid = trim($response->body());

            if (empty($cid)) {
                throw new \Exception('Failed to get CID from molecule name in PubChem');
            }

            $searchCidUrl = "https://pubchem.ncbi.nlm.nih.gov/rest/pug/compound/cid/{$cid}/property/MolecularFormula,Inchi,CanonicalSMILES,IUPACName,MolecularWeight,XLogP,HBondDonorCount,HBondAcceptorCount,RotatableBondCount,ExactMass,MonoisotopicMass,TPSA,HeavyAtomCount,Charge,Complexity,IsotopeAtomCount,DefinedAtomStereoCount,UndefinedAtomStereoCount,DefinedBondStereoCount,UndefinedBondStereoCount,CovalentUnitCount/JSON";

            $response = Http::get($searchCidUrl);
            $data = json_decode($response->body());

            if (isset($data->PropertyTable->Properties[0])) {
                $properties = $data->PropertyTable->Properties[0];

                return response()->json([
                    'cid' => $cid,
                    'MolecularFormula' => $properties->MolecularFormula,
                    'InChI' => $properties->InChI,
                    'CanonicalSMILES' => $properties->CanonicalSMILES,
                    'IUPACName' => $properties->IUPACName,
                    'MolecularWeight' => $properties->MolecularWeight,
                    'XLogP' => $properties->XLogP,
                    'HBondDonorCount' => $properties->HBondDonorCount,
                    'HBondAcceptorCount' => $properties->HBondAcceptorCount,
                    'RotatableBondCount' => $properties->RotatableBondCount,
                    'ExactMass' => $properties->ExactMass,
                    'MonoisotopicMass' => $properties->MonoisotopicMass,
                    'Tpsa' => $properties->TPSA,
                    'HeavyAtomCount' => $properties->HeavyAtomCount,
                    'Charge' => $properties->Charge,
                    'Complexity' => $properties->Complexity,
                    'IsotopeAtomCount' => $properties->IsotopeAtomCount,
                    'DefinedAtomStereoCount' => $properties->DefinedAtomStereoCount,
                    'UndefinedAtomStereoCount' => $properties->UndefinedAtomStereoCount,
                    'DefinedBondStereoCount' => $properties->DefinedBondStereoCount,
                    'UndefinedBondStereoCount' => $properties->UndefinedBondStereoCount,
                    'CovalentUnitCount' => $properties->CovalentUnitCount,
                ]);
            } else {
                throw new \Exception('Failed to get properties from CID in PubChem');
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function pubchemUrl(Molecule $molecule) {
        try {
            $cidUrl = "https://pubchem.ncbi.nlm.nih.gov/rest/pug/compound/name/{$molecule->name}/cids/TXT";
            $response = Http::get($cidUrl);
            $cid = trim($response->body());

            if (empty($cid)) {
                throw new \Exception('Failed to get CID from molecule name in PubChem');
            }

            $pubchemUrl = "https://pubchem.ncbi.nlm.nih.gov/compound/{$cid}";
            return redirect($pubchemUrl);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function downloadSdf2D(Molecule $molecule) {
        try {
            $moleculeName = $molecule->name;

            $cidUrl = "https://pubchem.ncbi.nlm.nih.gov/rest/pug/compound/name/{$moleculeName}/cids/TXT";
            $response = Http::get($cidUrl);

            if (!$response->successful()) {
                throw new \Exception('Failed to get CID from molecule name in PubChem');
                exit();
            }
            $cid = trim($response->body());

            $sdfUrl = "https://pubchem.ncbi.nlm.nih.gov/rest/pug/compound/CID/{$cid}/SDF?record_type=2d&response_type=save&response_basename={$molecule->name}-2D";
            return redirect($sdfUrl);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function downloadSdf3D(Molecule $molecule) {
        try {
            $moleculeName = $molecule->name;

            $cidUrl = "https://pubchem.ncbi.nlm.nih.gov/rest/pug/compound/name/{$moleculeName}/cids/TXT";
            $response = Http::get($cidUrl);

            if (!$response->successful()) {
                throw new \Exception('Failed to get CID from molecule name in PubChem');
            }
            $cid = trim($response->body());

            $sdfUrl = "https://pubchem.ncbi.nlm.nih.gov/rest/pug/compound/CID/{$cid}/SDF?record_type=3d&response_type=save&response_basename={$molecule->name}-2D";
            return redirect($sdfUrl);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function downloadJson2D(Molecule $molecule) {
        try {
            $moleculeName = $molecule->name;

            $cidUrl = "https://pubchem.ncbi.nlm.nih.gov/rest/pug/compound/name/{$moleculeName}/cids/TXT";
            $response = Http::get($cidUrl);

            if (!$response->successful()) {
                throw new \Exception('Failed to get CID from molecule name in PubChem');
            }
            $cid = trim($response->body());

            $json2d = "https://pubchem.ncbi.nlm.nih.gov/rest/pug/compound/cid/{$cid}/JSON";

            $jsonContent = Http::get($json2d)->body();

            return response()->streamDownload(function () use ($jsonContent) {
                echo $jsonContent;
            }, "{$molecule->name}-2D.json", ['Content-Type' => 'application/json']);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function downloadJson3D(Molecule $molecule) {
        try {
            $moleculeName = $molecule->name;

            $cidUrl = "https://pubchem.ncbi.nlm.nih.gov/rest/pug/compound/name/{$moleculeName}/cids/TXT";
            $response = Http::get($cidUrl);

            if (!$response->successful()) {
                throw new \Exception('Failed to get CID from molecule name in PubChem');
            }
            $cid = trim($response->body());

            $json3d = "https://pubchem.ncbi.nlm.nih.gov/rest/pug/compound/cid/{$cid}/JSON?record_type=3d";

            $jsonContent = Http::get($json3d)->body();

            return response()->streamDownload(function () use ($jsonContent) {
                echo $jsonContent;
            }, "{$molecule->name}-3D.json", ['Content-Type' => 'application/json']);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function downloadXml2D(Molecule $molecule) {
        try {
            $moleculeName = $molecule->name;

            $cidUrl = "https://pubchem.ncbi.nlm.nih.gov/rest/pug/compound/name/{$moleculeName}/cids/TXT";
            $response = Http::get($cidUrl);

            if (!$response->successful()) {
                throw new \Exception('Failed to get CID from molecule name in PubChem');
            }
            $cid = trim($response->body());

            $xml2d = "https://pubchem.ncbi.nlm.nih.gov/rest/pug/compound/cid/{$cid}/xml";

            $jsonContent = Http::get($xml2d)->body();

            return response()->streamDownload(function () use ($jsonContent) {
                echo $jsonContent;
            }, "{$molecule->name}-2D.xml", ['Content-Type' => 'application/xml']);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function downloadXml3D(Molecule $molecule) {
        try {
            $moleculeName = $molecule->name;

            $cidUrl = "https://pubchem.ncbi.nlm.nih.gov/rest/pug/compound/name/{$moleculeName}/cids/TXT";
            $response = Http::get($cidUrl);

            if (!$response->successful()) {
                throw new \Exception('Failed to get CID from molecule name in PubChem');
            }
            $cid = trim($response->body());

            $xml3d = "https://pubchem.ncbi.nlm.nih.gov/rest/pug/compound/cid/{$cid}/xml?record_type=3d";
            $jsonContent = Http::get($xml3d)->body();

            return response()->streamDownload(function () use ($jsonContent) {
                echo $jsonContent;
            }, "{$molecule->name}-3D.xml", ['Content-Type' => 'application/xml']);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function downloadAsnt2D(Molecule $molecule) {
        try {
            $moleculeName = $molecule->name;

            $cidUrl = "https://pubchem.ncbi.nlm.nih.gov/rest/pug/compound/name/{$moleculeName}/cids/TXT";
            $response = Http::get($cidUrl);

            if (!$response->successful()) {
                throw new \Exception('Failed to get CID from molecule name in PubChem');
            }
            $cid = trim($response->body());

            $asnt2d = "https://pubchem.ncbi.nlm.nih.gov/rest/pug/compound/cid/{$cid}/Asnt";
            $jsonContent = Http::get($asnt2d)->body();

            return response()->streamDownload(function () use ($jsonContent) {
                echo $jsonContent;
            }, "{$molecule->name}-2D.asnt", ['Content-Type' => 'application/asnt']);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function downloadAsnt3D(Molecule $molecule) {
        try {
            $moleculeName = $molecule->name;

            $cidUrl = "https://pubchem.ncbi.nlm.nih.gov/rest/pug/compound/name/{$moleculeName}/cids/TXT";
            $response = Http::get($cidUrl);

            if (!$response->successful()) {
                throw new \Exception('Failed to get CID from molecule name in PubChem');
            }
            $cid = trim($response->body());

            $asnt3d = "https://pubchem.ncbi.nlm.nih.gov/rest/pug/compound/cid/{$cid}/Asnt?record_type=3d";
            $jsonContent = Http::get($asnt3d)->body();

            return response()->streamDownload(function () use ($jsonContent) {
                echo $jsonContent;
            }, "{$molecule->name}-2D.asnt", ['Content-Type' => 'application/asnt']);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Molecule $molecule) {
        return view('molecules.edit', ['molecule' => $molecule]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Molecule $molecule) {
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'class' => 'nullable|string|max:255',
            'stereochemistry' => 'nullable|string|max:255',
            'chemical_similarity' => 'nullable|string|max:255',
            'formula' => 'nullable|string|max:255',
            'smiles' => 'nullable|string|max:255',
            'inchi' => 'nullable|string|max:255',
            'methodology' => 'nullable|string|max:255',
            'iupac' => 'nullable|string|max:255',
            'molecular_weight' => 'nullable|string|max:255',
            'x_log_p' => 'nullable|string|max:255',
            'h_bond_donor_count' => 'nullable|string|max:255',
            'h_bond_acceptor_count' => 'nullable|string|max:255',
            'rotatable_bond_count' => 'nullable|string|max:255',
            'exact_mass' => 'nullable|string|max:255',
            'monoisotopic_mass' => 'nullable|string|max:255',
            'tpsa' => 'nullable|string|max:255',
            'heavy_atom_count' => 'nullable|string|max:255',
            'charge' => 'nullable|string|max:255',
            'complexity' => 'nullable|string|max:255',
            'isotope_atom_count' => 'nullable|string|max:255',
            'defined_atom_stereo_count' => 'nullable|string|max:255',
            'undefined_atom_stereo_count' => 'nullable|string|max:255',
            'defined_bond_stereo_count' => 'nullable|string|max:255',
            'undefined_bond_stereo_count' => 'nullable|string|max:255',
            'covalent_unit_count' => 'nullable|string|max:255',
            'status' => 'string|max:255',
            'notes' => 'nullable|string|max:5550'
        ]);

        try {
            $molecule->update($validatedData);
        } catch (\Exception $e) {
            return redirect()->route('molecules.index')->with('error', 'Failed to update molecule');
        }

        return redirect()->route('molecules.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Molecule $molecule) {
        $plant_molecules = Plant_Molecule::where('molecule_id', $molecule->id)->get();
        foreach ($plant_molecules as $plant_molecule) {
            $plant_molecule->update(['molecule_id' => null]);
        }
        $molecule->delete();
        return redirect()->route('molecules.index');
    }
}
