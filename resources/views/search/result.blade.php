@section('title', ucfirst(__('messages.Search result')))

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl dark:text-gray-200 text-gray-800  leading-tight">
            {{ ucfirst(__('messages.Search result')) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 bg-white  shadow-sm sm:rounded-lg z-index: 9999;">
                <div class="p-6 dark:text-gray-100 text-gray-900 ">
                    <h1 class="text-2xl text-center mb-4 font-bold">{{ ucfirst(__('messages.plants')) }} </h1>
                    @if ($plants && count($plants) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>{{ __('messages.Species') }}</th>
                                        <th>{{ __('messages.Synonyms') }}</th>
                                        <th>{{ __('messages.Material') }}</th>
                                        <th>{{ __('messages.Geolocation') }}</th>
                                    </tr>
                                </thead>

                                <tbody class="text-center">
                                    @foreach ($plants as $plant)
                                        <tr class="odd:bg-gray-200 dark:odd:bg-gray-700">
                                            <td>{{ $plant->species }}</td>
                                            <td>{{ $plant->synonyms }}</td>
                                            <td>{{ $plant->material }}</td>
                                            <td>{{ $plant->geolocation }}</td>
                                            <td>
                                                <x-dropdown align="right" width="48">
                                                    <x-slot name="trigger">
                                                        <button>

                                                            <div class="ms-1">
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                                    width="24" height="24" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                                                </svg>
                                                            </div>
                                                        </button>
                                                    </x-slot>

                                                    <x-slot name="content">
                                                        <x-dropdown-link :href="route('plants.show', [$plant])">
                                                            {{ ucfirst(__('messages.Details')) }}
                                                        </x-dropdown-link>
                                                        @if ($userIsAdmin)
                                                            <x-dropdown-link :href="route('plants.edit', $plant)">
                                                                {{ ucfirst(__('messages.Edit')) }}
                                                            </x-dropdown-link>
                                                            <x-dropdown-link href="#"
                                                                x-on:click.prevent="
                                                            const form = document.querySelector('#deletePlantForm');
                                                            const parts = form.action.split('/');
                                                            parts[parts.length - 1] = {{ $plant->id }};
                                                            const newAction = parts.join('/');
                                                            form.action = newAction;
                                                            $dispatch('open-modal', 'confirm-plant-deletion')"
                                                                class="rounded-md dark:bg-red-500 bg-red-500 hover:dark:bg-red-600 hover:bg-red-600">
                                                                {{ ucfirst(__('messages.Delete')) }}
                                                            </x-dropdown-link>
                                                        @endif
                                                    </x-slot>
                                                </x-dropdown>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center">
                            {{ __('messages.Nothing was found with this search') }}
                        </p>

                    @endif

                </div>

                @if ($plants->hasPages())
                    <div class="mx-auto pb-10 w-4/5">
                        {{ $plants->links() }}
                    </div>
                @endif

            </div>

            <div class="dark:bg-gray-800 bg-white  shadow-sm sm:rounded-lg z-index: 9999; mt-12">
                <div class="p-6 dark:text-gray-100 text-gray-900 ">
                    <h1 class="text-2xl text-center mb-4 font-bold">{{ ucfirst(__('messages.molecules')) }}</h1>
                    @if ($molecules && count($molecules) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>{{ ucfirst(__('messages.name')) }}</th>
                                        <th>{{ __('messages.Class') }}</th>
                                        <th>{{ __('messages.Formula') }}</th>
                                        <th>{{ __('messages.Methodology') }}</th>
                                        <th>{{ __('messages.Iupac') }}</th>
                                    </tr>
                                </thead>

                                <tbody class="text-center">
                                    @foreach ($molecules as $molecule)
                                        <tr class="odd:bg-gray-200 dark:odd:bg-gray-700">
                                            <td>{{ $molecule->name }}</td>
                                            <td>{{ $molecule->class }}</td>
                                            <td>{{ $molecule->formula }}</td>
                                            <td>{{ $molecule->methodology }}</td>
                                            <td>{{ $molecule->iupac }}</td>
                                            <td>
                                                <x-dropdown align="right" width="48">
                                                    <x-slot name="trigger">
                                                        <button>

                                                            <div class="ms-1">
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                                    width="24" height="24" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                                                </svg>
                                                            </div>
                                                        </button>
                                                    </x-slot>

                                                    <x-slot name="content">
                                                        <x-dropdown-link :href="route('molecules.show', [$molecule])">
                                                            {{ ucfirst(__('messages.Details')) }}
                                                        </x-dropdown-link>
                                                        @if ($userIsAdmin)
                                                            <x-dropdown-link :href="route('molecules.edit', $molecule)">
                                                                {{ ucfirst(__('messages.Edit')) }}
                                                            </x-dropdown-link>
                                                            <x-dropdown-link href="#"
                                                                x-on:click.prevent="
                                                                const form = document.querySelector('#deleteMoleculeForm');
                                                                const parts = form.action.split('/');
                                                                parts[parts.length - 1] = {{ $molecule->id }};
                                                                const newAction = parts.join('/');
                                                                form.action = newAction;
                                                                $dispatch('open-modal', 'confirm-molecule-deletion');"
                                                                class="rounded-md dark:bg-red-500 bg-red-500 hover:dark:bg-red-600 hover:bg-red-600">
                                                                {{ ucfirst(__('messages.Delete')) }}
                                                            </x-dropdown-link>
                                                        @endif
                                                    </x-slot>
                                                </x-dropdown>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center">
                            @if (request()->query())
                                {{ __('messages.Nothing was found with this search') }}
                            @else
                                {{ __('messages.No molecule has been registered yet') }}
                            @endif
                        </p>

                    @endif

                </div>

                @if ($molecules->hasPages())
                    <div class="mx-auto pb-10 w-4/5">
                        {{ $molecules->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>

    @if ($userIsAdmin)
        <x-modal name="confirm-plant-deletion" :show="session('showConfirmPlantDeletionModal')" focusable>
            <div class="p-4">
                <form id="deletePlantForm" action="{{ route('plants.destroy', ['plant' => ' ']) }}" method="post">
                    @csrf
                    @method('delete')

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('messages.Are you sure you want to delete this plant?') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('messages.Once deleted, this plant and its data will be permanently removed.') }}
                    </p>

                    <div class="mt-6">
                        <x-input-label for="confirm-delete" value="{{ __('Confirm Delete') }}" class="sr-only" />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ ucfirst(__('messages.cancel')) }}
                        </x-secondary-button>

                        <x-danger-button class="ms-3">
                            {{ __('messages.Delete plant') }}
                        </x-danger-button>
                    </div>
                </form>
            </div>
        </x-modal>

        <x-modal name="confirm-molecule-deletion" :show="session('showConfirmMoleculeDeletionModal')" focusable>
            <div class="p-4">
                <form id="deleteMoleculeForm" action="{{ route('molecules.destroy', ['molecule' => ' ']) }}"
                    method="post">
                    @csrf
                    @method('delete')

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('messages.Are you sure you want to delete this molecule?') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('messages.Once deleted, this molecule and its data will be permanently removed.') }}
                    </p>

                    <div class="mt-6">
                        <x-input-label for="confirm-delete" value="{{ __('Confirm Delete') }}" class="sr-only" />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ ucfirst(__('messages.cancel')) }}
                        </x-secondary-button>

                        <x-danger-button class="ms-3">
                            {{ __('messages.Delete molecule') }}
                        </x-danger-button>
                    </div>
                </form>
            </div>
        </x-modal>
    @endif

</x-app-layout>
