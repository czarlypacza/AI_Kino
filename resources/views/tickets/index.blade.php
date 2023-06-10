<!DOCTYPE html>
<html lang="en">
<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Filmy</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/tempusdominus-bootstrap-4@5.39.0/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-p_primary-400 md:text-lg" x-data="{ darkMode: true }">
@include('layouts.navigation')

<div class="row w-100 mt-3">
    <div class="col-11 mt-3 mx-auto">
        <h3 class="font-semibold text-5xl text-p_accent-600">Bilety</h3>

        <table class="table mt-4 ">
        <thead class="text-p_accent-700">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Film</th>
                <th scope="col">Data</th>
                <th scope="col">Godzina</th>
                <th scope="col">Sala</th>
                <th scope="col">Rząd</th>
                <th scope="col">Miejsce</th>
                <th scope="col">Cena</th>
                @can('is-admin')
                <th scope="col">Użytkownik</th>
                <th scope="col">Status</th>
                <th scope="col">Akcje</th>
                @endcan
            </tr>
        </thead>
            <tbody class="text-p_support-50">
            @foreach ($tickets as $ticket)
                @if((\Illuminate\Support\Facades\Auth::user()->email==$ticket->user->email&&$ticket->status=="paid")||\Illuminate\Support\Facades\Auth::user()->can('is-admin'))
                <tr>
                    <th scope="row">{{ $ticket->id }} </th>
                    <td>{{ $ticket->showtime->show->movie->title }}</td>
                    <td>{{ $ticket->showtime->show->date }}</td>
                    <td>{{ $ticket->showtime->time }}</td>
                    <td>{{ $ticket->showtime->room_id }}</td>
                    <td>{{ $ticket->row }}</td>
                    <td>{{ $ticket->seat }}</td>
                    <td>{{ $ticket->price }}</td>
                    @can('is-admin')
                    @if($ticket->user!=null)
                    <td><a href="">{{ $ticket->user->name }}</a>  </td>
                    @else
                        <td>Gość</td>
                    @endif
                    @if($ticket->status=="pending")
                        <td>Oczekujący</td>
                        @elseif($ticket->status=="paid")
                        <td>Opłacony</td>
                    @endif
                    <td>
                        <form method="POST" action="{{ route('tickets.destroy',[$ticket]) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn bg-red-600 btn-sm hover:border-gray-800" type="submit">Usuń</button>
                        </form>
                    </td>
                    @endcan
            </tr>
                @endif
            @endforeach
            </tbody>
        </table>


    </div>
</div>
<div class="d-flex justify-content-center mb-2">
    {{ $tickets->links() }}
</div>

@include('shared\footer')

</body>
</html>
