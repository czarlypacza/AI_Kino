<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class=" bg-p_primary-500 text-p_support-50 rounded-3 p-3">
        @csrf
        <div >
            <a href="/">
                <x-application-logo class="w-20 h-20 mx-auto fill-current text-p_support-50" />
            </a>
        </div>
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-p_support-50" />
            <x-text-input id="email" class="block mt-1 w-full bg-p_secondary-300 rounded-3 text-p_support-50" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-p_accent-600" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Hasło')" class="text-p_support-50" />
            <x-text-input id="password" class="block mt-1 w-full bg-p_secondary-300 rounded-3 text-p_support-50" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-p_accent-600" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center text-p_support-50">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Zapamiętaj mnie') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-p_support-50 hover:text-p_accent-600 focus:outline-none focus:ring-2 focus:ring-p_accent-600" href="{{ route('password.request') }}">
                    {{ __('Zapomnialeś hasła?') }}
                </a>
            @endif

            <x-primary-button class="ml-3 bg-p_support-50 text-p_accent-600 hover:bg-p_accent-700 hover:text-p_accent-300">
                {{ __('Zaloguj') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
