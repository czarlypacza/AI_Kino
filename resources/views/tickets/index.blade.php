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
<body class="font-sans antialiased" x-data="{ darkMode: true }">
@include('layouts.navigation')

<div class="row w-100 mt-3">
    <div class="col-11 mt-3 mx-auto">
        <h3 class="font-semibold text-5xl">Bilety</h3>

        <table class="table table-striped mt-4 ">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Film</th>
                <th scope="col">Data</th>
                <th scope="col">Godzina</th>
                <th scope="col">Sala</th>
                <th scope="col">Rząd</th>
                <th scope="col">Miejsce</th>
                <th scope="col">Cena</th>
                <th scope="col">Użytkownik</th>
                <th scope="col">Akcje</th>
            </tr>
        </thead>
            <tbody>
            @foreach ($tickets as $ticket)
                <tr>
                    <th scope="row">{{ $ticket->id }}</th>
                    <td>{{ $ticket->showtime->show->movie->title }}</td>
                    <td>{{ $ticket->showtime->show->date }}</td>
                    <td>{{ $ticket->showtime->time }}</td>
                    <td>{{ $ticket->showtime->room_id }}</td>
                    <td>{{ $ticket->row }}</td>
                    <td>{{ $ticket->seat }}</td>
                    <td>{{ $ticket->price }}</td>
                    @if($ticket->user!=null)
                    <td><a href="">{{ $ticket->user->name }}</a>  </td>
                    @else
                        <td>Gość</td>
                    @endif
                    <td>
                        <form method="POST" action="{{ route('tickets.destroy',[$ticket]) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn bg-red-600 btn-sm hover:border-gray-800" type="submit">Usuń</button>
                        </form>
                    </td>
            </tr>
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
