@php
    use App\Enums\Status;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ ucfirst(__('messages.molecules')) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ ucfirst(__('messages.information about molecule')) }}
                            </h2>
                        </header>

                        <form method="post" action="{{ route('molecules.store') }}" class="mt-6 space-y-6"
                            enctype="multipart/form-data">
                            @csrf

                            <div>
                                <x-input-label for="status" :value="ucfirst(__('messages.Search Status'))" />
                                <select id="status" name="status"
                                    class="bg-gray-50 border text-gray-900 text-sm block w-full p-2.5 dark:placeholder-gray-400 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option selected disabled>{{ __('messages.Choose an status') }}</option>
                                    @php
                                        $statuses = [
                                            Status::NotInitialized => __('messages.Not Initialized'),
                                            Status::InProgress => __('messages.In Progress'),
                                            Status::Completed => __('messages.Completed'),
                                        ];
                                    @endphp

                                    @foreach ($statuses as $statusKey => $statusValue)
                                        <option value="{{ $statusKey }}">{{ $statusValue }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('status')" />
                            </div>

                            <div>
                                <x-input-label for="name" :value="ucfirst(__('messages.name'))" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                    required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="class" :value="ucfirst(__('messages.Class'))" />
                                <x-text-input id="class" name="class" type="text" class="mt-1 block w-full"
                                    autofocus autocomplete="class" />
                                <x-input-error class="mt-2" :messages="$errors->get('class')" />
                            </div>

                            <div>
                                <x-input-label for="methodology" :value="ucfirst(__('messages.Methodology'))" />
                                <x-text-input id="methodology" name="methodology" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="methodology" />
                                <x-input-error class="mt-2" :messages="$errors->get('methodology')" />
                            </div>

                            <div>
                                <x-input-label for="stereochemistry" :value="ucfirst(__('messages.Stereochemistry'))" />
                                <x-text-input id="stereochemistry" name="stereochemistry" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="stereochemistry" />
                                <x-input-error class="mt-2" :messages="$errors->get('stereochemistry')" />
                            </div>

                            <div>
                                <x-input-label for="formula" :value="ucfirst(__('messages.Formula'))" />
                                <x-text-input id="formula" name="formula" type="text" class="mt-1 block w-full"
                                    autofocus autocomplete="formula" />
                                <x-input-error class="mt-2" :messages="$errors->get('formula')" />
                            </div>

                            <div>
                                <x-input-label for="smiles" :value="ucfirst(__('messages.Smiles'))" />
                                <x-text-input id="smiles" name="smiles" type="text" class="mt-1 block w-full"
                                    autofocus autocomplete="smiles" />
                                <x-input-error class="mt-2" :messages="$errors->get('smiles')" />
                            </div>

                            <div>
                                <x-input-label for="inchi" :value="ucfirst(__('messages.Inchi'))" />
                                <x-text-input id="inchi" name="inchi" type="text" class="mt-1 block w-full"
                                    autofocus autocomplete="inchi" />
                                <x-input-error class="mt-2" :messages="$errors->get('inchi')" />
                            </div>


                            <div>
                                <x-input-label for="iupac" :value="ucfirst(__('messages.Iupac'))" />
                                <x-text-input id="iupac" name="iupac" type="text" class="mt-1 block w-full"
                                    autofocus autocomplete="iupac" />
                                <x-input-error class="mt-2" :messages="$errors->get('iupac')" />
                            </div>

                            <div>
                                <x-input-label for="molecular_weight" :value="ucfirst(__('messages.Molecular Weight'))" />
                                <x-text-input id="molecular_weight" name="molecular_weight" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="molecular_weight" />
                                <x-input-error class="mt-2" :messages="$errors->get('molecular_weight')" />
                            </div>

                            <div>
                                <x-input-label for="x_log_p" :value="ucfirst(__('messages.XLogP'))" />
                                <x-text-input id="x_log_p" name="x_log_p" type="text" class="mt-1 block w-full"
                                    autofocus autocomplete="x_log_p" />
                                <x-input-error class="mt-2" :messages="$errors->get('x_log_p')" />
                            </div>

                            <div>
                                <x-input-label for="h_bond_donor_count" :value="ucfirst(__('messages.Hydrogen Bond Donor Count'))" />
                                <x-text-input id="h_bond_donor_count" name="h_bond_donor_count" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="h_bond_donor_count" />
                                <x-input-error class="mt-2" :messages="$errors->get('h_bond_donor_count')" />
                            </div>

                            <div>
                                <x-input-label for="rotatable_bond_count" :value="ucfirst(__('messages.Rotatable Bond Count'))" />
                                <x-text-input id="rotatable_bond_count" name="rotatable_bond_count" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="rotatable_bond_count" />
                                <x-input-error class="mt-2" :messages="$errors->get('rotatable_bond_count')" />
                            </div>

                            <div>
                                <x-input-label for="h_bond_acceptor_count" :value="ucfirst(__('messages.Hydrogen Bond Acceptor Count'))" />
                                <x-text-input id="h_bond_acceptor_count" name="h_bond_acceptor_count" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="h_bond_acceptor_count" />
                                <x-input-error class="mt-2" :messages="$errors->get('h_bond_acceptor_count')" />
                            </div>

                            <div>
                                <x-input-label for="exact_mass" :value="ucfirst(__('messages.Exact Mass'))" />
                                <x-text-input id="exact_mass" name="exact_mass" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="exact_mass" />
                                <x-input-error class="mt-2" :messages="$errors->get('exact_mass')" />
                            </div>

                            <div>
                                <x-input-label for="monoisotopic_mass" :value="ucfirst(__('messages.Monoisotopic Mass'))" />
                                <x-text-input id="monoisotopic_mass" name="monoisotopic_mass" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="monoisotopic_mass" />
                                <x-input-error class="mt-2" :messages="$errors->get('monoisotopic_mass')" />
                            </div>

                            <div>
                                <x-input-label for="tpsa" :value="ucfirst(__('messages.Topological Polar Surface Area'))" />
                                <x-text-input id="tpsa" name="tpsa" type="text" class="mt-1 block w-full"
                                    autofocus autocomplete="tpsa" />
                                <x-input-error class="mt-2" :messages="$errors->get('tpsa')" />
                            </div>

                            <div>
                                <x-input-label for="heavy_atom_count" :value="ucfirst(__('messages.Heavy Atom Count'))" />
                                <x-text-input id="heavy_atom_count" name="heavy_atom_count" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="heavy_atom_count" />
                                <x-input-error class="mt-2" :messages="$errors->get('heavy_atom_count')" />
                            </div>

                            <div>
                                <x-input-label for="charge" :value="ucfirst(__('messages.Formal Charge'))" />
                                <x-text-input id="charge" name="charge" type="text" class="mt-1 block w-full"
                                    autofocus autocomplete="charge" />
                                <x-input-error class="mt-2" :messages="$errors->get('charge')" />
                            </div>

                            <div>
                                <x-input-label for="complexity" :value="ucfirst(__('messages.Complexity'))" />
                                <x-text-input id="complexity" name="complexity" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="complexity" />
                                <x-input-error class="mt-2" :messages="$errors->get('complexity')" />
                            </div>

                            <div>
                                <x-input-label for="isotope_atom_count" :value="ucfirst(__('messages.Isotope Atom Count'))" />
                                <x-text-input id="isotope_atom_count" name="isotope_atom_count" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="isotope_atom_count" />
                                <x-input-error class="mt-2" :messages="$errors->get('isotope_atom_count')" />
                            </div>

                            <div>
                                <x-input-label for="defined_atom_stereo_count" :value="ucfirst(__('messages.Defined Atom Stereocenter Count'))" />
                                <x-text-input id="defined_atom_stereo_count" name="defined_atom_stereo_count"
                                    type="text" class="mt-1 block w-full" autofocus
                                    autocomplete="defined_atom_stereo_count" />
                                <x-input-error class="mt-2" :messages="$errors->get('defined_atom_stereo_count')" />
                            </div>

                            <div>
                                <x-input-label for="undefined_atom_stereo_count" :value="ucfirst(__('messages.Undefined Atom Stereocenter Count'))" />
                                <x-text-input id="undefined_atom_stereo_count" name="undefined_atom_stereo_count"
                                    type="text" class="mt-1 block w-full" autofocus
                                    autocomplete="undefined_atom_stereo_count" />
                                <x-input-error class="mt-2" :messages="$errors->get('undefined_atom_stereo_count')" />
                            </div>

                            <div>
                                <x-input-label for="defined_bond_stereo_count" :value="ucfirst(__('messages.Defined Bond Stereocenter Count'))" />
                                <x-text-input id="defined_bond_stereo_count" name="defined_bond_stereo_count"
                                    type="text" class="mt-1 block w-full" autofocus
                                    autocomplete="defined_bond_stereo_count" />
                                <x-input-error class="mt-2" :messages="$errors->get('defined_bond_stereo_count')" />
                            </div>

                            <div>
                                <x-input-label for="undefined_bond_stereo_count" :value="ucfirst(__('messages.Undefined Bond Stereocenter Count'))" />
                                <x-text-input id="undefined_bond_stereo_count" name="undefined_bond_stereo_count"
                                    type="text" class="mt-1 block w-full" autofocus
                                    autocomplete="undefined_bond_stereo_count" />
                                <x-input-error class="mt-2" :messages="$errors->get('undefined_bond_stereo_count')" />
                            </div>

                            <div>
                                <x-input-label for="covalent_unit_count" :value="ucfirst(__('messages.Covalently-Bonded Unit Count'))" />
                                <x-text-input id="covalent_unit_count" name="covalent_unit_count" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="covalent_unit_count" />
                                <x-input-error class="mt-2" :messages="$errors->get('covalent_unit_count')" />
                            </div>

                            <div>
                                <x-input-label for="notes" :value="ucfirst(__('messages.Notes'))" />
                                <textarea id="notes" rows="4" name="notes"
                                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('messages.save') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function getValue(value) {
        if (value === 0 || value) {
            return value;
        } else {
            return '';
        }
    }

    function stripInChIPrefix(inchi) {
        const prefix = "InChI=";
        if (inchi.startsWith(prefix)) {
            return inchi.substring(prefix.length);
        }
        return inchi;
    }

    const moleculeNameInput = document.getElementById('name');

    moleculeNameInput.addEventListener('blur', async () => {
        const moleculeName = moleculeNameInput.value;

        try {
            const response = await fetch(`/molecules/${encodeURIComponent(moleculeName)}/pubchemSearch`);
            if (!response.ok) {
                throw new Error('Failed to fetch molecule details');
            }
            const data = await response.json();

            document.getElementById('formula').value = getValue(data.MolecularFormula);
            document.getElementById('smiles').value = getValue(data.CanonicalSMILES);
            document.getElementById('inchi').value = stripInChIPrefix(getValue(data.InChI));
            document.getElementById('iupac').value = getValue(data.IUPACName);
            document.getElementById('molecular_weight').value = getValue(data
                .MolecularWeight);
            document.getElementById('x_log_p').value = getValue(data.XLogP);
            document.getElementById('h_bond_donor_count').value = getValue(data.HBondDonorCount);
            document.getElementById('rotatable_bond_count').value = getValue(data.RotatableBondCount);
            document.getElementById('h_bond_acceptor_count').value = getValue(data.HBondAcceptorCount);
            document.getElementById('exact_mass').value = getValue(data.ExactMass);
            document.getElementById('monoisotopic_mass').value = getValue(data.MonoisotopicMass);
            document.getElementById('tpsa').value = getValue(data.Tpsa);
            document.getElementById('heavy_atom_count').value = getValue(data.HeavyAtomCount);
            document.getElementById('charge').value = getValue(data.Charge);
            document.getElementById('complexity').value = getValue(data.Complexity);
            document.getElementById('isotope_atom_count').value = getValue(data.IsotopeAtomCount);
            document.getElementById('defined_atom_stereo_count').value = getValue(data
                .DefinedAtomStereoCount);
            document.getElementById('undefined_atom_stereo_count').value = getValue(data
                .UndefinedAtomStereoCount);
            document.getElementById('defined_bond_stereo_count').value = getValue(data
                .DefinedBondStereoCount);
            document.getElementById('undefined_bond_stereo_count').value = getValue(data
                .UndefinedBondStereoCount);
            document.getElementById('covalent_unit_count').value = getValue(data.CovalentUnitCount);

        } catch (error) {
            console.error('Error:', error);
            // Handle error appropriately, e.g., show error message to the user
        }
    });
</script>
