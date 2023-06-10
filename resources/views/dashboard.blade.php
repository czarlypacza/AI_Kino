<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p_accent-500 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-p_primary-400">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-p_secondary-300 dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-full">
                    <h2 class="font-semibold text-xl text-p_accent-700 dark:text-gray-200 leading-tight">
                        Seanse teraz
                    </h2>

                    <div class="mt-4">
                        <x-table-layout>
                            <x-slot name="headings">
                                <th class="w-1/4 text-p_accent-700 dark:text-gray-200">
                                    Sala
                                </th>
                                <th class="text-p_accent-700 dark:text-gray-200">
                                    Film
                                </th>
                            </x-slot>

                            @foreach($showtimes as $showtime)
                                <x-showtimes-now :showtime="$showtime" class="text-p_support-50 dark:text-gray-400" />
                            @endforeach
                        </x-table-layout>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-6 bg-p_primary-400">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-p_secondary-300 dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-full">
                    <h2 class="font-semibold text-xl text-p_accent-700 dark:text-gray-200 leading-tight">
                        Zapisani użytkownicy
                    </h2>

                    <div class="mt-4">
                        <x-table-layout>
                            <x-slot name="headings">
                                <th class="text-p_accent-700 dark:text-gray-200">
                                    Id
                                </th>
                                <th class="text-p_accent-700 dark:text-gray-200">
                                    Imie
                                </th>
                                <th class="text-p_accent-700 dark:text-gray-200">
                                    e-mail
                                </th>
                                <th class="text-p_accent-700 dark:text-gray-200">
                                    Rola
                                </th>
                                <th class="text-p_accent-700 dark:text-gray-200">
                                    Akcje
                                </th>
                            </x-slot>

                            @foreach($users as $user)
                                <x-user-row :user="$user" class="text-p_support-50 dark:text-gray-400" />
                            @endforeach

                        </x-table-layout>

                        <div class="mt-4 flex justify-center">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-6 bg-p_primary-400">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-p_secondary-300 dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-full">
                    <h2 class="font-semibold text-xl text-p_accent-700 dark:text-gray-200 leading-tight">
                        Dodaj użytkownika
                    </h2>

                    <div class="mt-4">
                        <form method="POST" action="{{ route('users.store') }}" class="text-p_support-50 dark:text-gray-400">
                            @csrf
                            <div>
                                <x-input-label for="name" :value="__('Name')" class="text-p_accent-700 dark:text-gray-200"/>
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2 text-p_error dark:text-p_error-dark" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" class="text-p_accent-700 dark:text-gray-200"/>
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-p_error dark:text-p_error-dark" />
                            </div>

                            <div>
                                <x-input-label for="password" :value="__('Hasło')" class="text-p_accent-700 dark:text-gray-200"/>
                                <x-text-input id="password" name="password" type="text" class="mt-1 block w-full" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-p_error dark:text-p_error-dark" />
                            </div>

                            <div>
                                <x-input-label for="role" :value="__('Role')" class="text-p_accent-700 dark:text-gray-200"/>
                                <select id="role" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="role_id" required>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>

                                <x-input-error :messages="$errors->get('role_id')" class="mt-2 text-p_error dark:text-p_error-dark" />
                            </div>

                            <div class="flex items-center gap-4 mt-6">
                                <x-primary-button class="bg-p_accent-700 hover:bg-p_accent-600 text-p_support-50">{{ __('Save') }}</x-primary-button>

                                @if (session('status') === 'user-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400"
                                    >{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
