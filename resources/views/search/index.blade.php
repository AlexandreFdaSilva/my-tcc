<style>
    /* Custom CSS for autocomplete results */
    .aa-ItemWrapper {
        padding: 1px;
        border-bottom: 1px solid #ccc;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('messages.Find what you want!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-center">

                    <div class="relative shadow-md rounded-3xl w-5/6">

                        <div id="autocomplete"></div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/algoliasearch@4.23.3/dist/algoliasearch.umd.js"
    integrity="sha256-76mmfHsYYb491qbcs1Vd/iK80pdRqKCOEYJtPEy8dys=" crossorigin="anonymous"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@algolia/autocomplete-theme-classic" />

<script src="https://cdn.jsdelivr.net/npm/@algolia/autocomplete-js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@algolia/autocomplete-plugin-tags/dist/theme.min.css" />
<script src="https://cdn.jsdelivr.net/npm/@algolia/autocomplete-plugin-tags"></script>

<script>
    const {
        autocomplete,
        getAlgoliaResults,
    } = window['@algolia/autocomplete-js'];
    const searchClient = algoliasearch('{{ env('ALGOLIA_APP_ID') }}', '{{ env('ALGOLIA_SEARCH') }}');

    autocomplete({
        container: '#autocomplete',
        placeholder: '{{ __('messages.Search here for what you want! Molecules, plants and more') }}',
        insights: true,
        getSources({
            query
        }) {
            return [{
                getItems() {
                    return getAlgoliaResults({
                        searchClient,
                        queries: [{
                            indexName: 'molecules', // Specify the index name
                            query,
                            params: {
                                hitsPerPage: 5,
                                attributesToSnippet: [
                                    'name:10',
                                    'class:35',
                                    'formula:40',
                                ],
                                snippetEllipsisText: '…',
                            },
                        }, {
                            indexName: 'plants', // Specify the index name
                            query,
                            params: {
                                hitsPerPage: 5,
                                attributesToSnippet: [
                                    'species:10',
                                    'material:35',
                                    'molecules:35',
                                    'references:35'
                                ],
                                snippetEllipsisText: '…',
                            },
                        }],
                    });
                },
                templates: {
                    item({
                        item,
                        components,
                        html
                    }) {
                        if (item.__autocomplete_indexName === 'molecules') {
                            var moleculeID = item.objectID.match(/\d+$/)[0];
                            return html`
                            <a href="/molecules/${moleculeID}">
                                <div class="aa-ItemWrapper">
                                    <div class="aa-ItemContent">
                                        <!--
                                        <div class="h-28 w-28">
                                            <img src="/molecules/${moleculeID}/image" alt="${item.name}" class="h-full w-full"/>
                                        </div>
                                        -->
                                        <div class="aa-ItemContentBody">
                                            <h3>{{ __('messages.Molecule') }}</h3>
                                            ${(() => {
                                                if (item.name != '' && item.name != null) {
                                                    return html`
                                                    <div class="aa-ItemContentTitle">
                                                        {{ __('messages.name') }}: ${components.Highlight({
                                                            hit: item,
                                                            attribute: 'name',
                                                        })}
                                                    </div>
                                                    `;
                                                }
                                            })()}
                                            ${(() => {
                                                if (item.formula != '' && item.formula != null) {
                                                    return html`
                                                    <div class="aa-ItemContentDescription">
                                                        {{ __('messages.Formula') }}: ${components.Highlight({
                                                        hit: item,
                                                        attribute: 'formula',
                                                        })}
                                                    </div>
                                                    `;
                                                }
                                            })()}
                                            ${(() => {
                                                if (item.class != '' && item.class != null) {
                                                    return html`
                                                    <div class="aa-ItemContentDescription">
                                                        {{ __('messages.Class') }}: ${components.Snippet({
                                                        hit: item,
                                                        attribute: 'class',
                                                        })}
                                                    </div>
                                                    `;
                                                }
                                            })()}
                                        </div>
                                    </div>
                                </div>
                                </a>
                            `;
                        } else if (item.__autocomplete_indexName === 'plants') {
                            var plantID = item.objectID.match(/\d+$/)[0];
                            return html`
                            <a href="/plants/${plantID}">
                                <div class="aa-ItemWrapper">
                                    <div class="aa-ItemContent flex align-center">
                                        <!--
                                            <div class="h-28 w-28">
                                                <img src="${item.image_path ? item.image_path : '{{ asset('assets/images/placeholder.svg') }}'}" alt="${item.name}" class="h-full w-full"/>
                                            </div>
                                        -->

                                        <div class="aa-ItemContentBody">
                                            <h3>{{ __('messages.Plant') }}</h3>
                                            ${(() => {
                                                if (item.species != '' && item.species != null) {
                                                    return html`
                                                    <div class="aa-ItemContentTitle">
                                                        {{ __('messages.Species') }}: ${components.Highlight({
                                                        hit: item,
                                                        attribute: 'species',
                                                        })}
                                                    </div>
                                                    `;
                                                }
                                            })()}
                                            ${(() => {
                                                if (item.synonyms != '' && item.synonyms != null) {
                                                    return html`
                                                    <div class="aa-ItemContentDescription">
                                                        {{ __('messages.Synonyms') }}: ${components.Highlight({
                                                        hit: item,
                                                        attribute: 'synonyms',
                                                        })}
                                                    </div>
                                                    `;
                                                }
                                            })()}
                                            ${(() => {
                                                if (item.geolocation != '' && item.geolocation != null) {
                                                    return html`
                                                    <div class="aa-ItemContentDescription">
                                                        {{ __('messages.Geolocation') }}: ${components.Snippet({
                                                        hit: item,
                                                        attribute: 'geolocation',
                                                        })}
                                                    </div>
                                                    `;
                                                }
                                            })()}
                                            ${(() => {
                                                if (item.material != '' && item.material != null) {
                                                    return html`
                                                    <div class="aa-ItemContentDescription">
                                                        {{ __('messages.Material') }}: ${components.Snippet({
                                                        hit: item,
                                                        attribute: 'material',
                                                        })}
                                                    </div>
                                                    `;
                                                }
                                            })()}
                                            ${(() => {
                                                if (item.molecules && item.molecules.length > 0) {
                                                    return html`
                                                        <div class="aa-ItemContentDescription">
                                                            {{ __('messages.Molecule(s)') }}: ${item.molecules.map(molecule => molecule).join(', ')}
                                                        </div>
                                                    `;
                                                }
                                            })()}
                                            ${(() => {
                                                if (item.authors && item.authors.length > 0) {
                                                    return html`
                                                        <div class="aa-ItemContentDescription">
                                                            {{ __('messages.Author(s)') }}: ${item.authors.map(author => author).join(', ')}
                                                        </div>
                                                    `;
                                                }
                                            })()}
                                        </div>
                                    </div>
                                </div>
                            </a>
                            `;
                        }
                    },
                },
            }, ];
        },
        renderNoResults({
            render,
            html,
            state
        }, root) {
            render(
                html`
                    <div class="p-4">
                        {{ __('messages.No results found for') }} "${state.query}"
                    </div>
                `,
                root
            )
        },
    });

    document.getElementById('autocomplete').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();

            const query = document.querySelector('.aa-Input').value;

            const url = '/search?q=' + encodeURIComponent(query);

            window.location.replace(url);
        }

    });
</script>
