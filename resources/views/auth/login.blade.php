
<x-guest-layout>
	<!-- Session Status -->
	<x-auth-session-status class="mb-4" :status="session('status')" />

	<div class="flex justify-end">
		<input type="checkbox" name="light-switch" id="light-switch" class="light-switch sr-only" />
		<label class="relative cursor-pointer p-2" for="light-switch">
			<svg class="dark:hidden" width="16" height="16" xmlns="http://www.w3.org/2000/svg">
				<path class="fill-slate-300"
					d="M7 0h2v2H7zM12.88 1.637l1.414 1.415-1.415 1.413-1.413-1.414zM14 7h2v2h-2zM12.95 14.433l-1.414-1.413 1.413-1.415 1.415 1.414zM7 14h2v2H7zM2.98 14.364l-1.413-1.415 1.414-1.414 1.414 1.415zM0 7h2v2H0zM3.05 1.706 4.463 3.12 3.05 4.535 1.636 3.12z" />
				<path class="fill-slate-400" d="M8 4C5.8 4 4 5.8 4 8s1.8 4 4 4 4-1.8 4-4-1.8-4-4-4Z" />
			</svg>
			<svg class="hidden dark:block" width="16" height="16" xmlns="http://www.w3.org/2000/svg">
				<path class="fill-slate-400"
					d="M6.2 1C3.2 1.8 1 4.6 1 7.9 1 11.8 4.2 15 8.1 15c3.3 0 6-2.2 6.9-5.2C9.7 11.2 4.8 6.3 6.2 1Z" />
				<path class="fill-slate-500"
					d="M12.5 5a.625.625 0 0 1-.625-.625 1.252 1.252 0 0 0-1.25-1.25.625.625 0 1 1 0-1.25 1.252 1.252 0 0 0 1.25-1.25.625.625 0 1 1 1.25 0c.001.69.56 1.249 1.25 1.25a.625.625 0 1 1 0 1.25c-.69.001-1.249.56-1.25 1.25A.625.625 0 0 1 12.5 5Z" />
			</svg>
			<span class="sr-only">Switch to light / dark version</span>
		</label>
	</div>

	<form method="POST" action="{{ route('login') }}">
		@csrf

		<!-- Email Address -->
		<div>
			<x-input-label for="email" :value="ucfirst(__('messages.email'))" />
			<x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
				autofocus autocomplete="username" />
			<x-input-error :messages="$errors->get('email')" class="mt-2" />
		</div>

		<!-- Password -->
		<div class="mt-4">
			<x-input-label for="password" :value="ucfirst(__('messages.password'))" />

			<x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
				autocomplete="current-password" />

			<x-input-error :messages="$errors->get('password')" class="mt-2" />
		</div>

		<!-- Remember Me -->
		<div class="block mt-4">
			<label for="remember_me" class="inline-flex items-center">
				<input id="remember_me" type="checkbox"
					class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
					name="remember">
				<span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('messages.Remember me') }}</span>
			</label>
		</div>

		{{-- <div class="flex items-center justify-end mt-4"> --}}
			<div class="flex justify-between mt-4">
				@if (Route::has('password.request'))
				<a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
					href="{{ route('password.request') }}">
					{{ ucfirst(__('messages.Forgot your password?')) }}
				</a>
				@endif

				<!-- Adicionando um espaço entre os blocos -->
				<span class="mx-2"></span>

				<a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
					href="{{ route('register') }}">
					{{ ucfirst(__('messages.Not registered?')) }}
				</a>

				<x-primary-button class="ms-3">
					{{ ucfirst(__('messages.Log in')) }}
				</x-primary-button>
			</div>
	</form>
</x-guest-layout>

<script>
    const lightSwitches = document.querySelectorAll('.light-switch');
    if (lightSwitches.length > 0) {
		lightSwitches.forEach((lightSwitch, i) => {
            if (localStorage.getItem('dark-mode') === 'true') {
                lightSwitch.checked = true;
            }
            lightSwitch.addEventListener('change', () => {
                const {
                    checked
                } = lightSwitch;
                lightSwitches.forEach((el, n) => {
                    if (n !== i) {
                        el.checked = checked;
                    }
                });
				const body = document.body;
                if (lightSwitch.checked) {
                    // document.documentElement.classList.add('dark');
					body.classList.add('dark');
                    localStorage.setItem('dark-mode', true);
                } else {
					// document.documentElement.classList.remove('dark');
					body.classList.remove('dark');
                    localStorage.setItem('dark-mode', false);
                }
            });
        });
    }
</script>