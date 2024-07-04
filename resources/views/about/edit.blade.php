<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('messages.About us') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ ucfirst(__('messages.About us')) }}
                        </h2>
                    </header>
                    <br />
                    <form method="post" action="{{ route('about.update') }}" class="mt-6 space-y-6"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div>
                            <x-input-label for="title" :value="ucfirst(__('messages.Title'))" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                required autofocus autocomplete="title" value="{{ $about->title }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="summary" :value="ucfirst(__('messages.Summary'))" />
                            <x-text-input id="summary" name="summary" type="text" class="mt-1 block w-full"
                                required autofocus autocomplete="summary" value="{{ $about->summary }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('summary')" />
                        </div>

                        <div>
                            <x-input-label for="link" :value="ucfirst(__('messages.Link'))" />
                            <textarea id="summary" name="summary" rows="5"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                required autofocus autocomplete="summary">{{ $about->summary }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('link')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('messages.save') }}</x-primary-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
