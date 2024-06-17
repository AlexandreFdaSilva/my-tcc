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
                <div class="flex justify-between">
                    <div style="width: 36rem;">
                        <header class="flex justify-between">
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ ucfirst(__('messages.information about plant')) }}
                            </h2>
                        </header>
                    </div>

                    @if ($admin)
                        <div class="flex items-end mb-4">

                            <a href="{{ route('plants.edit', $plant) }}">
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
                                <div class="mt-1">
                                    <img src="{{ isset($plant->image_path) ? asset($plant->image_path) : asset('assets/images/placeholder.svg') }}"
                                        alt="Molecule Image" class="w-60">
                                </div>
                            </div>

                            <div class="mt-6">
                                <x-input-label for="species" :value="ucfirst(__('messages.Species'))" />
                                <x-text-input id="species" title="species" name="species" type="text"
                                    class="mt-1 block w-full" required autofocus autocomplete="species"
                                    value="{{ $plant->species }}" disabled />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="synonyms" :value="ucfirst(__('messages.Synonyms'))" />
                                <x-text-input id="synonyms" name="synonyms" type="text" class="mt-1 block w-full"
                                    required autofocus autocomplete="synonyms" value="{{ $plant->synonyms }}"
                                    disabled />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="material" :value="ucfirst(__('messages.Material'))" />
                                <x-text-input id="material" name="material" type="text" class="mt-1 block w-full"
                                    required autofocus autocomplete="material" value="{{ $plant->material }}"
                                    disabled />
                            </div>

                            @if (filter_var($plant->geolocation, FILTER_VALIDATE_URL))
                                <div class="mt-4">
                                    <x-input-label for="geolocation" :value="ucfirst(__('messages.Geolocation'))" />
                                    <div class="w-full relative">
                                        <div
                                            class="p-3 rounded-md flex gap-2 w-full border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm mt-1 truncate h-12 bg-white">
                                            <span id="geolocation-span">
                                                <a href="{{ $plant->geolocation }}" target="_blank">
                                                    {{ $plant->geolocation }}
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="mt-4">
                                    <x-input-label for="geolocation" :value="ucfirst(__('messages.Geolocation'))" />
                                    <x-text-input id="geolocation" name="geolocation" type="text"
                                        class="mt-1 block w-full" required autofocus autocomplete="geolocation"
                                        value="{{ $plant->geolocation }}" disabled />
                                </div>
                            @endif

                            @if ($sections)
                                <header>
                                    <h2 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ ucfirst(__('messages.Molecules and references')) }}
                                    </h2>
                                </header>
                            @endif

                            {{-- Sections = Array of[reference, [molecules]] --}}
                            @foreach ($sections as $sectionIndex => $section)
                                <div id="reference-section">
                                    <div class="flex justify-between items-center">
                                        <header class="flex-1 text-center">
                                            <h2 id="header-section"
                                                class="mt-4 text-base font-medium text-gray-900 dark:text-gray-100">
                                                {{ ucfirst(__('messages.Section')) }}
                                                {{ $sectionIndex + 1 }}</h2>
                                        </header>
                                    </div>

                                    @foreach ($section as $index => $referenceOrMolecule)
                                        @if ($index == 1)
                                            @php
                                                $molecules = $referenceOrMolecule;
                                            @endphp
                                        @endif
                                    @endforeach

                                    @if (isset($molecules))
                                        <div class="mt-4">
                                            <x-input-label for="molecule" :value="ucfirst(__('messages.Molecule(s)'))" />
                                            <div x-data="{ options: [], open: false, filter: '' }" class="w-full relative">
                                                <div
                                                    class="p-3 rounded-md flex gap-2 w-full border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm mt-1 truncate h-12 bg-white">
                                                    <span id="selected-options-display-{{ $sectionIndex }}">
                                                        @foreach ($molecules as $molecule)
                                                            <a href="{{ route('molecules.show', ['molecule' => $molecule]) }}"
                                                                target="_blank">{{ $molecule->name }}</a>{{ !$loop->last ? ',' : '' }}
                                                        @endforeach
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @foreach ($section as $index => $referenceOrMolecule)
                                        @if ($index == 0)
                                            @php
                                                $reference = $referenceOrMolecule;
                                            @endphp


                                            <header class="mt-4 text-base font-medium text-gray-900 dark:text-gray-100">
                                                {{ ucfirst(__('messages.Reference')) }}</header>

                                            <div class="mt-2">
                                                <input name="reference_univali-{{ $sectionIndex }}"
                                                    class="relative float-left me-[6px] mt-[0.15rem] h-[1.125rem] w-[1.125rem] appearance-none rounded-[0.25rem]"
                                                    type="checkbox" value="true" id="checkboxDefault"
                                                    @if ($reference->univali) @checked(true) @endif
                                                    disabled />
                                                <label
                                                    class="inline-block text-sm font-medium text-gray-900 dark:text-gray-100"
                                                    for="checkboxDefault">Univali</label>
                                            </div>

                                            <div class="mt-2">
                                                <x-input-label for="reference_title" :value="ucfirst(__('messages.Title'))" />
                                                <x-text-input name="reference_title-{{ $sectionIndex }}" type="text"
                                                    class="mt-1 block w-full" required autofocus autocomplete="off"
                                                    disabled value="{{ $reference->title }}" />
                                            </div>

                                            <div class="mt-4">
                                                <x-input-label for="reference_author" :value="ucfirst(__('messages.Author'))" />
                                                <x-text-input name="reference_author-{{ $sectionIndex }}"
                                                    type="text" class="mt-1 block w-full" required autofocus
                                                    autocomplete="off" disabled value="{{ $reference->author }}" />
                                            </div>

                                            {{-- <div class="mt-4">
                                                <x-input-label for="reference_doi" :value="ucfirst(__('messages.DOI'))" />
                                                <x-text-input name="reference_doi-{{ $sectionIndex }}" type="text"
                                                    class="mt-1 block w-full" required autofocus autocomplete="off"
                                                    disabled value="{{ $reference->doi }}" />
                                            </div> --}}

                                            <div class="mt-4">
                                                <x-input-label for="reference_doi" :value="ucfirst(__('messages.DOI'))" />
                                                <div class="w-full relative">
                                                    <div
                                                        class="p-3 rounded-md flex gap-2 w-full border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm mt-1 truncate h-12 bg-white">
                                                        <span id="reference_doi-{{ $sectionIndex }}">
                                                            <a
                                                                href="https://www.doi.org/{{ $reference->doi }}"target="_blank">{{ $reference->doi }}</a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <x-input-label for="reference_pmid" :value="ucfirst(__('messages.PMID'))" />
                                                <div class="w-full relative">
                                                    <div
                                                        class="p-3 rounded-md flex gap-2 w-full border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm mt-1 truncate h-12 bg-white">
                                                        <span id="reference_pmid-{{ $sectionIndex }}">
                                                            <a
                                                                href="https://pubmed.ncbi.nlm.nih.gov/{{ $reference->pmid }}"target="_blank">{{ $reference->pmid }}</a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                            @endforeach

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
