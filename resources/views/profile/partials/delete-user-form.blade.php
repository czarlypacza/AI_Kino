<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-p_accent-700 dark:text-gray-100">
            {{ __('Usuń konto') }}
        </h2>

        <p class="mt-1 text-sm text-p_support-50 dark:text-gray-400">
            {{ __('Ta akcja jest nie odwracalna .') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Usuń konto') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-p_primary-500">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-p_accent-700 dark:text-gray-100">
                {{ __('Czy jesteś pewny tej akcji?') }}
            </h2>

            <p class="mt-1 text-sm text-p_support-50 dark:text-gray-400">
                {{ __('Po usunięciu konta wszystkie zasoby i dane związane z nim zostaną trwale usunięte. Wprowadź swoje hasło, aby potwierdzić, że chcesz trwale usunąć swoje konto.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Hasło') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Hasło') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Anuluj') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Usuń') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
