@php
    use App\Helpers\StatusHelper;
@endphp

<script src="{{ asset('assets/js/lottiePlayer.js') }}"></script>

<x-app-layout>
    <x-slot name="header">
        <div class="flex space-x-2 items-center">
            <x-back-url />
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ ucfirst(__('messages.molecules')) }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="flex justify-between">
                    <div style="width: 36rem;">
                        <header class="flex justify-between">
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ ucfirst(__('messages.information about molecule')) }}
                            </h2>
                            <a id="pubchem-button" href="{{ route('molecules.pubchemUrl', [$molecule]) }}"
                                target="_blank" class="ml-12 hidden">
                                <x-primary-button
                                    class="min-w-40 justify-center">{{ __('messages.Go to the PubChem') }}</x-primary-button>
                            </a>
                        </header>
                    </div>

                    @if ($admin)
                        <div class="flex items-end mb-4">

                            <a href="{{ route('molecules.edit', $molecule) }}">
                                <x-primary-button>{{ __('messages.Edit') }}</x-primary-button>
                            </a>

                        </div>
                    @endif
                </div>
                <div class="max-w-xl">
                    <section>
                        <div class="mt-6 space-y-6">

                            <div>
                                <x-input-label for="image" :value="ucfirst(__('messages.Image'))" />
                                <div class="mt-1 relative w-60 h-60">
                                    <lottie-player id="loading-indicator" autoplay loop mode="normal"
                                        src="{{ asset('assets/images/loading.json') }}"
                                        class="w-full h-full absolute top-0 left-0 opacity-100 transition-opacity ease-in-out duration-500">
                                    </lottie-player>
                                    <img id="image-container"
                                        src="{{ route('molecule.pubchemImage', ['molecule' => $molecule->id]) }}"
                                        alt="Molecule Image"
                                        class="w-full h-full object-cover absolute top-0 left-0 opacity-0 transition-opacity ease-in-out duration-500">
                                </div>
                            </div>

                            <div>
                                <x-input-label for="status" :value="ucfirst(__('messages.Search Status'))" />
                                <x-text-input disabled id="status" name="status" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="status"
                                    value="{{ StatusHelper::getStatusText($molecule->status) }}" />
                            </div>

                            <div>
                                <x-input-label for="name" :value="ucfirst(__('messages.name'))" />
                                <x-text-input disabled id="name" name="name" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="name"
                                    value="{{ $molecule->name }}" />
                            </div>

                            <div>
                                <x-input-label for="class" :value="ucfirst(__('messages.Class'))" />
                                <x-text-input disabled id="class" name="class" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="class"
                                    value="{{ $molecule->class }}" />
                            </div>

                            <div>
                                <x-input-label for="methodology" :value="ucfirst(__('messages.Methodology'))" />
                                <x-text-input disabled id="methodology" name="methodology" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="methodology"
                                    value="{{ $molecule->methodology }}" />
                            </div>

                            <div>
                                <x-input-label for="stereochemistry" :value="ucfirst(__('messages.Stereochemistry'))" />
                                <x-text-input disabled id="stereochemistry" name="stereochemistry" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="stereochemistry"
                                    value="{{ $molecule->stereochemistry }}" />
                            </div>

                            <div>
                                <x-input-label for="formula" :value="ucfirst(__('messages.Formula'))" />
                                <x-text-input disabled id="formula" name="formula" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="formula"
                                    value="{{ $molecule->formula }}" />
                            </div>

                            <div>
                                <x-input-label for="smiles" :value="ucfirst(__('messages.Smiles'))" />
                                <x-text-input disabled id="smiles" name="smiles" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="smiles"
                                    value="{{ $molecule->smiles }}" />
                            </div>

                            <div>
                                <x-input-label for="inchi" :value="ucfirst(__('messages.Inchi'))" />
                                <x-text-input disabled id="inchi" name="inchi" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="inchi"
                                    value="{{ $molecule->inchi }}" />
                            </div>


                            <div>
                                <x-input-label for="iupac" :value="ucfirst(__('messages.Iupac'))" />
                                <x-text-input disabled id="iupac" name="iupac" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="iupac"
                                    value="{{ $molecule->iupac }}" />
                            </div>

                            <div>
                                <x-input-label for="molecularWeight" :value="ucfirst(__('messages.Molecular Weight'))" />
                                <x-text-input disabled id="molecularWeight" name="molecularWeight" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="molecularWeight"
                                    value="{{ $molecule->molecular_weight }} g/mol" />
                            </div>

                            <div>
                                <x-input-label for="xLogP" :value="ucfirst(__('messages.XLogP'))" />
                                <x-text-input disabled id="xLogP" name="xLogP" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="xLogP"
                                    value="{{ $molecule->x_log_p }}" />
                            </div>

                            <div>
                                <x-input-label for="hBondDonorCount" :value="ucfirst(__('messages.Hydrogen Bond Donor Count'))" />
                                <x-text-input disabled id="hBondDonorCount" name="hBondDonorCount" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="hBondDonorCount"
                                    value="{{ $molecule->h_bond_donor_count }}" />
                            </div>

                            <div>
                                <x-input-label for="rotatableBondCount" :value="ucfirst(__('messages.Rotatable Bond Count'))" />
                                <x-text-input disabled id="rotatableBondCount" name="rotatableBondCount"
                                    type="text" class="mt-1 block w-full" autofocus
                                    autocomplete="rotatableBondCount"
                                    value="{{ $molecule->rotatable_bond_count }}" />
                            </div>

                            <div>
                                <x-input-label for="hBondAcceptorCount" :value="ucfirst(__('messages.Hydrogen Bond Acceptor Count'))" />
                                <x-text-input disabled id="hBondAcceptorCount" name="hBondAcceptorCount"
                                    type="text" class="mt-1 block w-full" autofocus
                                    autocomplete="hBondAcceptorCount"
                                    value="{{ $molecule->h_bond_acceptor_count }}" />
                            </div>

                            <div>
                                <x-input-label for="exactMass" :value="ucfirst(__('messages.Exact Mass'))" />
                                <x-text-input disabled id="exactMass" name="exactMass" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="exactMass"
                                    value="{{ $molecule->exact_mass }} g/mol" />
                            </div>

                            <div>
                                <x-input-label for="monoisotopicMass" :value="ucfirst(__('messages.Monoisotopic Mass'))" />
                                <x-text-input disabled id="monoisotopicMass" name="monoisotopicMass" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="monoisotopicMass"
                                    value="{{ $molecule->monoisotopic_mass }} g/mol" />
                            </div>

                            <div>
                                <x-input-label for="tpsa" :value="ucfirst(__('messages.Topological Polar Surface Area'))" />
                                <x-text-input disabled id="tpsa" name="tpsa" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="tpsa"
                                    value="{{ $molecule->tpsa }}Å²" />
                            </div>

                            <div>
                                <x-input-label for="heavyAtomCount" :value="ucfirst(__('messages.Heavy Atom Count'))" />
                                <x-text-input disabled id="heavyAtomCount" name="heavyAtomCount" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="heavyAtomCount"
                                    value="{{ $molecule->heavy_atom_count }}" />
                            </div>

                            <div>
                                <x-input-label for="charge" :value="ucfirst(__('messages.Formal Charge'))" />
                                <x-text-input disabled id="charge" name="charge" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="charge"
                                    value="{{ $molecule->charge }}" />
                            </div>

                            <div>
                                <x-input-label for="complexity" :value="ucfirst(__('messages.Complexity'))" />
                                <x-text-input disabled id="complexity" name="complexity" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="complexity"
                                    value="{{ $molecule->complexity }}" />
                            </div>

                            <div>
                                <x-input-label for="isotopeAtomCount" :value="ucfirst(__('messages.Isotope Atom Count'))" />
                                <x-text-input disabled id="isotopeAtomCount" name="isotopeAtomCount" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="isotopeAtomCount"
                                    value="{{ $molecule->isotope_atom_count }}" />
                            </div>

                            <div>
                                <x-input-label for="definedAtomStereoCount" :value="ucfirst(__('messages.Defined Atom Stereocenter Count'))" />
                                <x-text-input disabled id="definedAtomStereoCount" name="definedAtomStereoCount"
                                    type="text" class="mt-1 block w-full" autofocus
                                    autocomplete="definedAtomStereoCount"
                                    value="{{ $molecule->defined_atom_stereo_count }}" />
                            </div>

                            <div>
                                <x-input-label for="undefinedAtomStereoCount" :value="ucfirst(__('messages.Undefined Atom Stereocenter Count'))" />
                                <x-text-input disabled id="undefinedAtomStereoCount" name="undefinedAtomStereoCount"
                                    type="text" class="mt-1 block w-full" autofocus
                                    autocomplete="undefinedAtomStereoCount"
                                    value="{{ $molecule->undefined_atom_stereo_count }}" />
                            </div>

                            <div>
                                <x-input-label for="definedBondStereoCount" :value="ucfirst(__('messages.Defined Bond Stereocenter Count'))" />
                                <x-text-input disabled id="definedBondStereoCount" name="definedBondStereoCount"
                                    type="text" class="mt-1 block w-full" autofocus
                                    autocomplete="definedBondStereoCount"
                                    value="{{ $molecule->defined_bond_stereo_count }}" />
                            </div>

                            <div>
                                <x-input-label for="undefinedBondStereoCount" :value="ucfirst(__('messages.Undefined Bond Stereocenter Count'))" />
                                <x-text-input disabled id="undefinedBondStereoCount" name="undefinedBondStereoCount"
                                    type="text" class="mt-1 block w-full" autofocus
                                    autocomplete="undefinedBondStereoCount"
                                    value="{{ $molecule->undefined_bond_stereo_count }}" />
                            </div>

                            <div>
                                <x-input-label for="covalentUnitCount" :value="ucfirst(__('messages.Covalently-Bonded Unit Count'))" />
                                <x-text-input disabled id="covalentUnitCount" name="covalentUnitCount" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="covalentUnitCount"
                                    value="{{ $molecule->covalent_unit_count }}" />
                            </div>

                            <div>
                                <x-input-label for="notes" :value="ucfirst(__('messages.Notes'))" />
                                <textarea disabled id="notes" rows="4"
                                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ $molecule->notes }}</textarea>
                            </div>

                            <div id="download-files-div" class="w-full hidden">
                                <div class="flex flex-wrap justify-between items-center gap-4">
                                    {{-- SDF --}}
                                    <a href="{{ route('molecules.downloadSdf2D', [$molecule]) }}" target="_blank"
                                        class="mr-2">
                                        <x-primary-button
                                            class="min-w-40 justify-center">{{ __('messages.Download 2D SDF') }}</x-primary-button>
                                    </a>
                                    <a href="{{ route('molecules.downloadSdf3D', [$molecule]) }}" target="_blank"
                                        class="mr-2">
                                        <x-primary-button
                                            class="min-w-40 justify-center">{{ __('messages.Download 3D SDF') }}</x-primary-button>
                                    </a>
                                    {{-- JSON --}}
                                    <a href="{{ route('molecules.downloadJson2D', [$molecule]) }}" target="_blank"
                                        class="mr-2">
                                        <x-primary-button
                                            class="min-w-40 justify-center">{{ __('messages.Download 2D JSON') }}</x-primary-button>
                                    </a>
                                    <a href="{{ route('molecules.downloadJson3D', [$molecule]) }}" target="_blank"
                                        class="mr-2">
                                        <x-primary-button
                                            class="min-w-40 justify-center">{{ __('messages.Download 3D JSON') }}</x-primary-button>
                                    </a>
                                    {{-- XML --}}
                                    <a href="{{ route('molecules.downloadXml2D', [$molecule]) }}" target="_blank"
                                        class="mr-2">
                                        <x-primary-button
                                            class="min-w-40 justify-center">{{ __('messages.Download 2D XML') }}</x-primary-button>
                                    </a>
                                    <a href="{{ route('molecules.downloadXml3D', [$molecule]) }}" target="_blank"
                                        class="mr-2">
                                        <x-primary-button
                                            class="min-w-40 justify-center">{{ __('messages.Download 3D XML') }}</x-primary-button>
                                    </a>
                                    {{-- ASNT --}}
                                    <a href="{{ route('molecules.downloadAsnt2D', [$molecule]) }}" target="_blank"
                                        class="mr-2">
                                        <x-primary-button
                                            class="min-w-40 justify-center">{{ __('messages.Download 2D ASNT') }}</x-primary-button>
                                    </a>
                                    <a href="{{ route('molecules.downloadAsnt3D', [$molecule]) }}" target="_blank"
                                        class="mr-2">
                                        <x-primary-button
                                            class="min-w-40 justify-center">{{ __('messages.Download 3D ASNT') }}</x-primary-button>
                                    </a>
                                    <a href="https://nmrshiftdb.nmr.uni-koeln.de/portal/js_pane/P-Results;?searchstring=C24H22O5&searchaction=exact&searchfield=chemical%20formula&eventSubmit_doGeneralsearch=Search"
                                        target="_blank" class="mr-2">
                                        <x-primary-button
                                            class="min-w-40 justify-center">{{ __('messages.Open NMR') }}</x-primary-button>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function hideLoadingIndicator() {
        var loadingIndicator = document.getElementById('loading-indicator');
        var imageContainer = document.getElementById('image-container');

        loadingIndicator.style.opacity = 0;
        imageContainer.style.opacity = 1;
    }

    function downloadFiles() {
        const downloadUrl = "{{ route('molecules.downloadSdf2D', [$molecule]) }}";

        fetch(downloadUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to fetch');
                }
                return response.text();
            })
            .then(data => {
                // If the response is not null or empty, show the button
                if (data.trim() !== '') {
                    document.getElementById('download-files-div').style.display = 'inline-block';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function pubchemUrl() {
        const downloadUrl = "{{ route('molecules.pubchemUrl', [$molecule]) }}";

        fetch(downloadUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to fetch');
                }
                return response.text();
            })
            .then(data => {
                // If the response is not null or empty, show the button
                if (data.trim() !== '') {
                    document.getElementById('pubchem-button').style.display = 'inline-block';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    window.onload = function() {
        new Promise((resolve, reject) => {
            setTimeout(function() {
                hideLoadingIndicator();
                resolve();
            }, 1000);
        });
        downloadFiles();
        pubchemUrl();
    };
</script>
