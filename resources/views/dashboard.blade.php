<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-grey-100 dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-full">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                        Seanse teraz
                    </h2>

                    <div class="mt-4">
                        <x-table-layout>
                            <x-slot name="headings">
                                <th class="w-1/4">Sala</th>
                                <th >Film</th>
                            </x-slot>


                        @foreach($showtimes as $showtime)
                                <x-showtimes-now :showtime="$showtime" />
                            @endforeach
                        </x-table-layout>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-grey-100 dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-full">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                        Zapisani użytkownicy
                    </h2>
                    <div class="mt-4">
                        <x-table-layout>
                            <x-slot name="headings">
                                <th >Id</th>
                                <th >Imie</th>
                                <th >e-mail</th>
                                <th >Rola</th>
                                <th >Akcje</th>
                            </x-slot>

                            @foreach($users as $user)
                                <x-user-row :user="$user" />
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
</x-app-layout>
