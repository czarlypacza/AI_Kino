<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Filmy</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/tempusdominus-bootstrap-4@5.39.0/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    @vite([ 'resources/css/app.css','public/css/bootstrap.css','resources/js/app.js','public/js/bootstrap.bundle.js'])

</head>

<body>
@include('layouts.navigation')
<div class="row w-100 mt-3">
    <div class="col-11 mt-3 mx-auto">
        <h3>Sale</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="accordion accordion-flush" id="accordionMovies">
            @foreach($rooms as $room)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne{{$room->id}}" aria-expanded="false"
                                aria-controls="flush-collapseOne">
                            Sala: {{ $room->id }}
                        </button>
                    </h2>
                    <div id="flush-collapseOne{{$room->id}}" class="accordion-collapse collapse"
                         aria-labelledby="flush-headingOne" data-bs-parent="#accordionMovies">
                        <div class="accordion-body">

                            <div class="row mb-3">
                                <div class="col col-6 text-center" >Rzędy: {{ $room->rows }}</div>
                                <div class="col col-6 text-center">Kolumny: {{ $room->cols }} </div>
                            </div>
                            <div class="row d-flex justify-content-around">
                                <div class="col col-3 text-center">
                                    <a data-bs-toggle="modal" data-bs-target="#moviesEDIT{{$room->id}}"
                                       class="btn btn-success  ">Edytuj</a>
                                    <div class="modal fade" id="moviesEDIT{{$room->id}}" tabindex="-1"
                                         aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="POST" action="{{route('rooms.update',[$room])}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            Edytuj sale</h5>
                                                        <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div
                                                        class="modal-body align-items-center justify-content-evenly">
                                                        <div class="input-group mb-1">
                                                            <input value="{{$room->rows}}" type="text" class="form-control"
                                                                   name="rows" placeholder="Rzędy (1-25)"
                                                                   aria-label="Rzędy"
                                                                   aria-describedby="basic-addon1">
                                                            <input value="{{$room->cols}}" type="text" class="form-control"
                                                                   name="cols" placeholder="Kolumny (1-25)"
                                                                   aria-label="Kolumny"
                                                                   aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">
                                                            Zapisz
                                                        </button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="col col-3 text-center">
                                    <form method="POST" action="{{ route('rooms.destroy',[$room]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger " type="submit">Usuń
                                        </button>
                                    </form>
                                </div>
                            </div>
{{--                            <h5>Najblizsze seanse</h5>--}}
{{--                            <div class="row mt-3 d-flex justify-content-around">--}}

{{--                                @php--}}
{{--                                    $data = \Illuminate\Support\Facades\DB::select('CALL GetShowsAfterToday(?);',[$room->id]);--}}
{{--                                @endphp--}}

{{--                            @foreach($data as $show)--}}
{{--                                    <div class="col-2 text-center rounded" style="border: 2px solid black; background-color: #ddd;">{{ $show->date }} {{ $show->time }}</div>--}}

{{--                                @endforeach--}}
{{--                            </div>--}}

                        </div>
                    </div>
                </div>
            @endforeach


        </div>

    </div>
</div>

<div class="row">
    <div class="col text-center">
        <a data-bs-toggle="modal" data-bs-target="#roomsADD"
           class="btn btn-primary btn-lg ">Dodaj sale</a>
        <div class="modal fade" id="roomsADD" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{route('rooms.store')}}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Dodaj sale</h5>
                            <button type="button" class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div
                            class="modal-body align-items-center justify-content-evenly">
                            <div class="input-group mb-1">
                                <input  type="text" class="form-control"
                                       name="rows" placeholder="Rzędy (1-25)"
                                       aria-label="Rzędy"
                                       aria-describedby="basic-addon1">
                                <input  type="text" class="form-control"
                                       name="cols" placeholder="Kolumny (1-25)"
                                       aria-label="Kolumny"
                                       aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                Zapisz
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@include('shared.footer')
<script src="{{ asset('js/bootstrap.bundle.js') }}"></script>

</body>
</html>
