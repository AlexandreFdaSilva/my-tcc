<x-app-layout>
    <x-slot name="header">
        <div class="flex space-x-2 items-center">
            <x-back-url />
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ ucfirst(__('messages.plants')) }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>

                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ ucfirst(__('messages.information about plant')) }}
                            </h2>
                        </header>

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="post" action="{{ route('plants.update', ['plant' => $plant]) }}"
                            class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')


                            <div id="imageDiv">
                                <x-input-label for="image" :value="ucfirst(__('messages.Image'))" />

                                <input id="dropzone-file" type="file" class="hidden" name="image"
                                    onchange="updateContent(event)" />

                                <button onclick="handleButtonClick()" type="button" class="relative mt-1">
                                    <div class="w-60 relative" onmouseover="hoverImage(true)"
                                        onmouseout="hoverImage(false)">
                                        <div class="relative">
                                            <img src="{{ isset($plant->image_path) ? $plant->image_path : asset('assets/images/placeholder.svg') }}"
                                                alt="Plant Image"
                                                class="w-auto h-auto transition-opacity duration-300 cursor-pointer"
                                                id="plantImage">
                                            <span
                                                class="absolute inset-0 flex justify-center items-center opacity-0 transition-opacity duration-300"
                                                id="hoverText">
                                                <label for="file-input"
                                                    class="cursor-pointer text-blue-600 flex flex-col items-center"
                                                    id="updateImage">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                                    </svg>
                                                    {{ __('messages.Change image') }}
                                                </label>
                                            </span>

                                        </div>
                                    </div>
                                </button>
                            </div>

                            <div class="items-center justify-center w-full hidden transition-opacity" id="div-dropzone">
                                <label for="dropzone-file"
                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
                                    id="dropzone-label">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6"
                                        id="dropzone-content">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-lg text-gray-500 dark:text-gray-400">
                                            {{ __('messages.Image of plant') }}
                                        </p>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold">{{ __('messages.Click to upload') }}</span>
                                            {{ __('messages.or drag and drop') }}
                                        </p>
                                        {{-- <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.800x400px)</p> --}}
                                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG</p>
                                    </div>
                                </label>
                            </div>

                            {{-- FIXME :messages erros on every single one --}}
                            <div class="mt-6">
                                <x-input-label for="species" :value="ucfirst(__('messages.Species'))" />
                                <x-text-input id="species" title="species" name="species" type="text"
                                    class="mt-1 block w-full" required autofocus value="{{ $plant->species }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="synonyms" :value="ucfirst(__('messages.Synonyms'))" />
                                <x-text-input id="synonyms" name="synonyms" type="text" class="mt-1 block w-full"
                                    autofocus autocomplete="synonyms" value="{{ $plant->synonyms }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="material" :value="ucfirst(__('messages.Material'))" />
                                <x-text-input id="material" name="material" type="text" class="mt-1 block w-full"
                                    autofocus autocomplete="material" value="{{ $plant->material }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="geolocation" :value="ucfirst(__('messages.Geolocation'))" />
                                <x-text-input id="geolocation" name="geolocation" type="text"
                                    class="mt-1 block w-full" autofocus autocomplete="geolocation"
                                    value="{{ $plant->geolocation }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <header>
                                <h2 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ ucfirst(__('messages.Molecules and references')) }}
                                </h2>
                            </header>

                            <div class="mt-4" id="references-molecules">
                                <button id="prevent-submit-btn"
                                    class="inline-flex items-center p-2 bg-gray-800 dark:bg-white border border-transparent rounded-full font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </button>
                            </div>


                            @php
                                $optionsValues = []; // Will be used inside the checkbox inputs
                            @endphp

                            {{-- Sections = Array of[reference, [molecules]] --}}
                            @foreach ($sections as $sectionIndex => $section)
                                <div id="reference-section">
                                    <div class="flex justify-between items-center">

                                        <div class="flex-1 items-center">
                                            <header class="flex-1 text-center">
                                                <h2 id="header-section"
                                                    class="mt-4 text-base font-medium text-gray-900 dark:text-gray-100">
                                                    {{ ucfirst(__('messages.Section')) }}
                                                    {{ $sectionIndex + 1 }}</h2>
                                            </header>
                                        </div>

                                        <div class="mt-4">
                                            <button id="remove-section-{{ $sectionIndex }}"
                                                class="inline-flex items-center p-2 bg-red-400 dark:bg-red-400 border border-transparent rounded-full font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-red-600 dark:hover:bg-red-600 focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 12h14" />
                                                </svg>
                                            </button>
                                        </div>

                                    </div>


                                    @foreach ($section as $index => $referenceOrMolecule)
                                        @if ($index == 1)
                                            @php
                                                $moleculesFromReference = $referenceOrMolecule;
                                            @endphp
                                        @endif
                                    @endforeach

                                    @if (isset($moleculesFromReference))
                                        @php
                                            $options = [];
                                        @endphp
                                        @foreach ($allMolecules as $molecule)
                                            @if ($moleculesFromReference->contains($molecule))
                                                @php
                                                    $value = $molecule->id . '_' . $molecule->name;
                                                    array_push($options, $value);
                                                @endphp
                                            @endif
                                        @endforeach
                                        @php
                                            array_push($optionsValues, $options);
                                        @endphp
                                        <div class="mt-4">
                                            <x-input-label for="molecule" :value="ucfirst(__('messages.Molecule(s)'))" />
                                            <div x-data="{ options: {{ json_encode($options) }}, open: false, filter: '' }" class="w-full relative">
                                                <div @click="open = !open"
                                                    class="p-3 rounded-md flex gap-2 w-full border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm mt-1 cursor-pointer truncate h-12 bg-white">
                                                    <span id="selected-options-display-{{ $sectionIndex }}">
                                                        @foreach ($moleculesFromReference as $molecule)
                                                            {{ $molecule->name }}{{ !$loop->last ? ',' : '' }}
                                                        @endforeach
                                                    </span>
                                                </div>
                                                <div class="max-h-48 overflow-auto p-3 pt-0 rounded-lg flex gap-3 w-full shadow-lg x-50 flex-col bg-white mt-3"
                                                    x-show="open" @click.outside="open = false"
                                                    @keydown.escape.window="open = false"
                                                    x-transition:enter=" ease-[cubic-bezier(.3,2.3,.6,1)] duration-200"
                                                    x-transition:enter-start="!opacity-0 !mt-0"
                                                    x-transition:enter-end="!opacity-1 !mt-3"
                                                    x-transition:leave=" ease-out duration-200"
                                                    x-transition:leave-start="!opacity-1 !mt-3"
                                                    x-transition:leave-end="!opacity-0 !mt-0">
                                                    <input x-model="filter"
                                                        placeholder="{{ __('messages.Search here') }}"
                                                        class="p-3 flex justify-center items-center border-transparent focus:border-transparent focus:ring-0 bg-w rounded-t-md"
                                                        type="text">
                                                    @foreach ($allMolecules as $molecule)
                                                        <div x-show="filter.length > 2 && $el.innerText.toLowerCase().includes(filter.toLowerCase())"
                                                            class="flex items-center"
                                                            id="div-checkbox-input-{{ $sectionIndex }}">
                                                            <input x-model="options"
                                                                id="molecule-checkbox-{{ $sectionIndex }}"
                                                                name="selected_molecules-{{ $sectionIndex }}-original[]"
                                                                type="checkbox"
                                                                value="{{ $molecule->id }}_{{ $molecule->name }}"
                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                                            <label for="{{ $molecule->name }}"
                                                                class="ml-2 text-sm font-medium text-gray-900 flex-grow">{{ $molecule->name }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @foreach ($section as $index => $referenceOrMolecule)
                                        @if ($index == 0)
                                            @php
                                                $reference = $referenceOrMolecule;
                                            @endphp


                                            <header
                                                class="mt-4 text-base font-medium text-gray-900 dark:text-gray-100">
                                                {{ ucfirst(__('messages.Reference')) }}
                                            </header>

                                            <div class="hidden">
                                                <x-input-label for="reference_id" :value="ucfirst(__('messages.Title'))" />
                                                <x-text-input name="reference_id-{{ $sectionIndex }}-original"
                                                    type="text" class="mt-1 block w-full" required autofocus
                                                    autocomplete="off" value="{{ $reference->id }}" />
                                            </div>

                                            <div class="mt-2">
                                                <input name="reference_univali-{{ $sectionIndex }}-original"
                                                    class="hover:cursor-pointer relative float-left me-[6px] mt-[0.15rem] h-[1.125rem] w-[1.125rem] appearance-none rounded-[0.25rem]"
                                                    type="checkbox" value="true"
                                                    id="checkboxDefault-{{ $sectionIndex }}-original"
                                                    @if ($reference->univali) @checked(true) @endif />
                                                <label
                                                    class="inline-block hover:cursor-pointer text-sm font-medium text-gray-900 dark:text-gray-100"
                                                    for="checkboxDefault-{{ $sectionIndex }}-original">Univali</label>
                                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                            </div>

                                            <div class="mt-2">
                                                <x-input-label for="reference_title" :value="ucfirst(__('messages.Title'))" />
                                                <x-text-input name="reference_title-{{ $sectionIndex }}-original"
                                                    type="text" class="mt-1 block w-full" required autofocus
                                                    autocomplete="off" value="{{ $reference->title }}" />
                                            </div>

                                            <div class="mt-4">
                                                <x-input-label for="reference_author" :value="ucfirst(__('messages.Author'))" />
                                                <x-text-input name="reference_author-{{ $sectionIndex }}-original"
                                                    type="text" class="mt-1 block w-full" autofocus
                                                    autocomplete="off" value="{{ $reference->author }}" />
                                            </div>

                                            <div class="mt-4">
                                                <x-input-label for="reference_doi" :value="ucfirst(__('messages.DOI'))" />
                                                <x-text-input name="reference_doi-{{ $sectionIndex }}-original"
                                                    type="text" class="mt-1 block w-full" autofocus
                                                    autocomplete="off" value="{{ $reference->doi }}" />
                                            </div>

                                            <div class="mt-4">
                                                <x-input-label for="reference_pmid" :value="ucfirst(__('messages.PMID'))" />
                                                <x-text-input name="reference_pmid-{{ $sectionIndex }}-original"
                                                    type="text" class="mt-1 block w-full" autofocus
                                                    autocomplete="off" value="{{ $reference->pmid }}" />
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endforeach

                            <div class="flex justify-center items-center mt-6">
                                <button
                                    class="inline-flex items-center px-20 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    {{ __('messages.save') }}
                                </button>
                            </div>

                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    let selectedOptions = @json($optionsValues);

    function getNamesFromMoleculesChekbox(index) {
        var selectedMoleculeNames = selectedOptions[index].map(value => {
            return value.split('_')[1];
        });
        return selectedMoleculeNames.join(', ');
    }

    // Function to handle checkbox change
    function handleCheckboxChange(event) {
        var labelValue = event.target.value;
        var index = event.target.id.split('-').slice(-1);

        if (!selectedOptions[index]) {
            selectedOptions[index] = [];
        }

        if (event.target.checked) {
            selectedOptions[index].push(labelValue);
        } else {
            selectedOptions[index] = selectedOptions[index].filter(option => option !== labelValue);
        }
        var moleculesName = getNamesFromMoleculesChekbox(index);
        var displayElement = document.querySelector('#selected-options-display-' + index);
        displayElement.textContent = moleculesName;
    }

    function updateSectionIndex(indexTarget) {
        var sections = document.querySelectorAll('#reference-section');
        sections.forEach((section, index) => {
            if (index >= indexTarget) {
                section.querySelector("#header-section").textContent = "{{ __('messages.Section') }} " +
                    (index + 1);
                section.querySelector('[id^="remove-section-"]').id = "remove-section-" + index;
                section.querySelector('[id^="selected-options-display-"]').id =
                    "selected-options-display-" +
                    index;
                var reference_title = section.querySelector('[name^="reference_title-"]');
                var reference_author = section.querySelector('[name^="reference_author-"]');
                var reference_doi = section.querySelector('[name^="reference_doi-"]');
                var reference_pmid = section.querySelector('[name^="reference_pmid-"]');
                var reference_univali = section.querySelector('[name^="reference_univali-"]');
                var reference_id = section.querySelector('[name^="reference_id-"]');
                reference_title.name = "reference_title-" + index + (reference_title.name.includes('original') ?
                    '-original' : '');
                reference_author.name = "reference_author-" + index + (reference_author.name.includes(
                    'original') ? '-original' : '');
                reference_doi.name = "reference_doi-" + index + (reference_doi.name.includes('original') ?
                    '-original' : '');
                reference_pmid.name = "reference_pmid-" + index + (reference_pmid.name.includes('original') ?
                    '-original' : '');
                reference_univali.name = "reference_univali-" + index + (reference_univali.name.includes(
                    'original') ? '-original' : '');
                reference_id.name = "reference_id-" + index + (reference_id.name.includes(
                    'original') ? '-original' : '');
                var selectedMolecules = section.querySelectorAll('[name^="selected_molecules-"]');
                selectedMolecules.forEach(selectedMolecule => {
                    selectedMolecule.name = "selected_molecules-" + index + '[]';
                    selectedMolecule.id = "molecule-checkbox-" + index;
                });
                index++;
            }
        });
    }

    document.querySelectorAll('[id^="div-checkbox-input"]' + '> [id^="molecule-checkbox-"]').forEach(
        checkbox => {
            checkbox.addEventListener('change', function(event) {
                handleCheckboxChange(event);
            });
        }
    );

    document.querySelectorAll('[id^="remove-section"]').forEach(
        element => {
            element.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default form submission behavior
                var sections = document.querySelectorAll('#reference-section');
                var index = this.id.split('-').slice(-1);
                if (sections.length >= 0) {
                    sections.item(index).remove();
                    selectedOptions.splice(index, 1);
                    updateSectionIndex(index);
                }
            });
        }
    );

    // Handle new mol/refs
    document.getElementById('prevent-submit-btn').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default form submission behavior
        var counter = document.querySelectorAll('#reference-section').length;
        var referenceHtml = `
		<div id="reference-section">
			<div class="flex justify-between items-center">

				<header class="flex-1 text-center">
					<h2 id="header-section" class="mt-4 text-base font-medium text-gray-900 dark:text-gray-100">{{ ucfirst(__('messages.Section')) }} ${counter + 1}</h2>
				</header>

				<div class="mt-4">
					<button id="remove-section-${counter}" class="inline-flex items-center p-2 bg-red-400 dark:bg-red-400 border border-transparent rounded-full font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-red-600 dark:hover:bg-red-600 focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
							<path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
						</svg>
					</button>
				</div>

			</div>


			<div class="mt-4">
				<x-input-label for="molecule" :value="ucfirst(__('messages.Molecule(s)'))" />
				<div x-data="{ options: [], open: false, filter: '' }" class="w-full relative">
					<div @click="open = !open" class="p-3 rounded-md flex gap-2 w-full border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm mt-1 cursor-pointer truncate h-12 bg-white">
						<span id="selected-options-display-${counter}">{{ __('messages.No molecules selected') }}</span>
					</div>
					<div class="max-h-48 overflow-auto p-3 pt-0 rounded-lg flex gap-3 w-full shadow-lg x-50 flex-col bg-white mt-3" x-show="open" @click.outside="open = false" @keydown.escape.window="open = false" x-transition:enter=" ease-[cubic-bezier(.3,2.3,.6,1)] duration-200" x-transition:enter-start="!opacity-0 !mt-0" x-transition:enter-end="!opacity-1 !mt-3" x-transition:leave=" ease-out duration-200" x-transition:leave-start="!opacity-1 !mt-3" x-transition:leave-end="!opacity-0 !mt-0">
						<input x-model="filter" placeholder="{{ __('messages.Search here') }}" class="p-3 flex justify-center items-center border-transparent focus:border-transparent focus:ring-0 bg-w rounded-t-md" type="text">
						@foreach ($allMolecules as $molecule)
						<div x-show="filter.length > 2 && $el.innerText.toLowerCase().includes(filter.toLowerCase())" class="flex items-center" id="div-checkbox-input-${counter}">
							<input x-model="options" id="molecule-checkbox-${counter}"  name="selected_molecules-${counter}[]" type="checkbox" value="{{ $molecule->id }}_{{ $molecule->name }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
							<label for="{{ $molecule->name }}" class="ml-2 text-sm font-medium text-gray-900 flex-grow">{{ $molecule->name }}</label>
						</div>
						@endforeach
					</div>
				</div>
			</div>


            <header class="mt-4 text-base font-medium text-gray-900 dark:text-gray-100">{{ ucfirst(__('messages.Reference')) }}</header>

            <div class="mt-2">
                <input name="reference_univali-${counter}" class="hover:cursor-pointer relative float-left me-[6px] mt-[0.15rem] h-[1.125rem] w-[1.125rem] appearance-none rounded-[0.25rem]" type="checkbox" value="true" id="checkboxDefault-${counter}" />
                <label class="inline-block hover:cursor-pointer text-sm font-medium text-gray-900 dark:text-gray-100" for="checkboxDefault-${counter}">Univali</label>
				<x-input-error class="mt-2" :messages="$errors->get('name')" />
			</div>

            <div class="mt-2">
				<x-input-label for="reference_title" :value="ucfirst(__('messages.Title'))" />
				<x-text-input name="reference_title-${counter}" type="text" class="mt-1 block w-full" required autofocus autocomplete="off" />
				<x-input-error class="mt-2" :messages="$errors->get('name')" />
			</div>

			<div class="mt-4">
				<x-input-label for="reference_author" :value="ucfirst(__('messages.Author'))" />
				<x-text-input name="reference_author-${counter}" type="text" class="mt-1 block w-full" autofocus autocomplete="off" />
				<x-input-error class="mt-2" :messages="$errors->get('name')" />
			</div>

			<div class="mt-4">
				<x-input-label for="reference_doi" :value="ucfirst(__('messages.DOI'))" />
				<x-text-input name="reference_doi-${counter}" type="text" class="mt-1 block w-full" autofocus autocomplete="off" />
				<x-input-error class="mt-2" :messages="$errors->get('name')" />
			</div>

			<div class="mt-4">
				<x-input-label for="reference_pmid" :value="ucfirst(__('messages.PMID'))" />
				<x-text-input name="reference_pmid-${counter}" type="text" class="mt-1 block w-full" autofocus autocomplete="off" />
				<x-input-error class="mt-2" :messages="$errors->get('name')" />
			</div>
		</div>
    `;

        // Add the new inputs
        let previoslySections = document.querySelectorAll("#reference-section");

        if (previoslySections.length > 0) {
            let position = previoslySections.length - 1;
            document.querySelectorAll('#reference-section')[position].insertAdjacentHTML('afterend',
                referenceHtml);
        } else {
            document.getElementById('references-molecules').insertAdjacentHTML('afterend',
                referenceHtml);
        }

        // Add listenner to the checkboxes of new molecules section
        document.querySelectorAll('div#div-checkbox-input-' + counter + '> [id^="molecule-checkbox-"]').forEach(
            checkbox => {
                checkbox.addEventListener('change', function(event) {
                    handleCheckboxChange(event);
                });
            }
        );

        document.getElementById('remove-section-' + counter).addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default form submission behavior
            var sections = document.querySelectorAll('#reference-section');
            var index = this.id.split('-').slice(-1);
            if (sections.length >= 0) {
                sections.item(index).remove();
                selectedOptions.splice(index, 1);
                updateSectionIndex(index);
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Function to handle file selection using input[type=file]
        function updateContent(event) {
            const file = event.target.files[0];
            const label = document.getElementById('dropzone-label');
            const content = document.getElementById('dropzone-content');

            if (file) {
                const fileName = file.name;
                content.innerHTML = `
                    <p class="mb-2 text-lg text-gray-500 dark:text-gray-400">${fileName}</p>
                    <p class="text-base text-gray-500 dark:text-gray-400">{{ __('messages.File uploaded') }}</p>
                `;
            }
        }

        // Event listener for file input change
        document.getElementById('dropzone-file').addEventListener('change', updateContent);

        // Dragover event listener for the dropzone div
        document.getElementById('div-dropzone').addEventListener('dragover', function(e) {
            e.preventDefault(); // Prevent default action (open file)
            e.stopPropagation(); // Stop event propagation
            e.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
        });

        // Drop event listener for the dropzone div
        document.getElementById('div-dropzone').addEventListener('drop', function(e) {
            e.preventDefault(); // Prevent default action (open file)
            e.stopPropagation(); // Stop event propagation

            const file = e.dataTransfer.files[0];
            const label = document.getElementById('dropzone-label');
            const content = document.getElementById('dropzone-content');
            const hiddenInput = document.getElementById('dropzone-file');

            if (file) {
                const fileName = file.name;

                const fileList = new DataTransfer();
                fileList.items.add(file);
                hiddenInput.files = fileList.files;

                content.innerHTML = `
                    <p class="mb-2 text-lg text-gray-500 dark:text-gray-400">${fileName}</p>
                    <p class="text-base text-gray-500 dark:text-gray-400">{{ __('messages.File uploaded') }}</p>
                `;
            }
        });
    });

    function handleButtonClick() {
        const image = document.getElementById('imageDiv');
        const dropZone = document.getElementById('div-dropzone');

        if (dropZone.classList.contains('hidden')) {

            image.classList.remove("hidden");
            image.classList.add("flex", "opacity-0", "transition-opacity", "ease-in-out", "duration-500");

            // After transition is complete, hide the image
            setTimeout(function() {
                image.classList.add("hidden");
            }, 500); // Adjust the time according to the transition duration
            setTimeout(function() {
                dropZone.classList.remove("hidden");
                dropZone.classList.add("flex", "opacity-100", "transition-opacity", "ease-in-out",
                    "duration-500");
            }, 500); // Adjust the time according to the transition duration


        }
    }

    function updateContent(event) {
        const label = document.getElementById('dropzone-label');
        const content = document.getElementById('dropzone-content');

        if (event.target.files.length > 0) {
            const fileName = event.target.files[0].name;
            content.innerHTML = `
                <p class="mb-2 text-lg text-gray-500 dark:text-gray-400">${fileName}</p>
                <p class="text-base text-gray-500 dark:text-gray-400">{{ __('messages.File uploaded') }}</p>
            `;
        }
    }

    function hoverImage(hover) {
        const image = document.getElementById('plantImage');
        const hoverText = document.getElementById('hoverText');

        if (hover) {
            image.style.filter = 'brightness(25%)';
            hoverText.style.opacity = '1';
        } else {
            image.style.filter = 'brightness(100%)';
            hoverText.style.opacity = '0';
        }
    }
</script>
