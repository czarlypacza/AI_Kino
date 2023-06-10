<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p_accent-600 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-p_primary-400 md:text-lg ">
        <div class="max-w-6xl  mx-auto sm:px-6 lg:px-8 space-y-6 flex justify-center" >
            <div class="p-4 sm:p-8 bg-p_secondary-300 md:min-w-full shadow sm:rounded-lg  flex flex-col align-content-stretch">
                <div class="w-full max-w-4xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
                <div class="w-full max-w-4xl pt-4">
                    @include('profile.partials.update-password-form')
                </div>
                <div class="w-full max-w-4xl pt-4">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
