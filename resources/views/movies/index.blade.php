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
</head>
<body>
@include('shared/nav')

<div class="row w-100 mt-5">
    <div class="col-11 mt-5 mx-auto">
        <h3>Filmy</h3>
{{--        <table class="table table-striped mt-4">--}}
{{--            <thead>--}}
{{--                <tr>--}}
{{--                    <th scope="col">#</th>--}}
{{--                    <th scope="col">Tytul</th>--}}
{{--                    <th scope="col">Opis</th>--}}
{{--                    <th scope="col">Reżyseria</th>--}}
{{--                    <th scope="col">Aktorzy</th>--}}
{{--                    <th scope="col">Czas trwania</th>--}}
{{--                    <th scope="col">Ocena</th>--}}
{{--                    <th scope="col">Gatunek</th>--}}
{{--                    <th scope="col">img</th>--}}
{{--                    <th scope="col">Akcje</th>--}}
{{--                </tr>--}}
{{--            </thead>--}}
{{--        </table>--}}
        <div class="accordion accordion-flush" id="accordionMovies">
            @foreach($movies as $movie)
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{$movie->id}}" aria-expanded="false" aria-controls="flush-collapseOne">
                        {{ $movie->title }}
                    </button>
                </h2>
                <div id="flush-collapseOne{{$movie->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionMovies">
                    <div class="accordion-body">

                        <div class="card mb-3" >
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="{{ asset($movie->image) }}" class="img-fluid rounded-start" alt="{{$movie->image}}">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h4 class="card-title">{{$movie->title}}</h4>
                                        <p class="card-text">{{$movie->description}}</p>
                                        <div class="row">
                                            <div class="col col-6">
                                                <h5>Reżyseria:</h5>
                                                <p>{{$movie->director}}</p>
                                            </div>
                                            <div class="col col-6">
                                                <h5>Aktorzy:</h5>
                                                <p>{{$movie->actors}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col-6">
                                                <p>Czas trwania:{{$movie->duration}} min</p>
                                            </div>
                                            <div class="col col-6">
                                                <p>Gatunek: @foreach ($movie->genre as $genre)
                                                        {{$genre->name}},
                                                    @endforeach</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            {{-- <button class="btn btn-info btn-lg" onclick="{{route('room.show',['room'=>$showtime->room,'showtime'=>$showtime])}}">Wybierz miejsca</button> --}}


                                            @can('is-admin')
                                                <div class="col col-3" >
                                                    <a data-bs-toggle="modal" data-bs-target="#showtimesADD"
                                                       class="btn btn-success btn-lg ">Edytuj</a>
                                                    <div class="modal fade" id="showtimesADD" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form method="POST" action="">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Dodaj godzine</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body d-flex align-items-center justify-content-evenly">


                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary" >Zapisz</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col col-3">
                                                    <form method="POST" action="{{ route('movies.destroy',[$movie]) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-lg " type="submit" >Usuń</button>

                                                    </form>
                                                </div>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>


    </div>
</div>



@include('shared\footer')
<script src="{{ asset('js/bootstrap.bundle.js') }}"></script>

</body>
</html>
