<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('messages.About us') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($admin)
                        <div class="flex justify-end mt-4">
                            <a href="{{ route('about.edit') }}">
                                <x-primary-button>{{ __('messages.Edit') }}</x-primary-button>
                            </a>
                        </div>
                    @endif
                    <p class="text-center text-2xl">{{ $about->title }}</p>

                    <br />

                    <p class="text-justify">
                        {!! nl2br(e(str_replace('\n', "\n", $about->summary))) !!}
                    </p>

                    <br />

                    <a href="{{ $about->link }}" target="_blank">{{ $about->link }}</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
