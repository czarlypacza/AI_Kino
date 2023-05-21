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
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne{{$movie->id}}" aria-expanded="false"
                                aria-controls="flush-collapseOne">
                            {{ $movie->title }}
                        </button>
                    </h2>
                    <div id="flush-collapseOne{{$movie->id}}" class="accordion-collapse collapse"
                         aria-labelledby="flush-headingOne" data-bs-parent="#accordionMovies">
                        <div class="accordion-body">

                            <div class="card mb-3">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="{{ asset($movie->image) }}" class="img-fluid rounded-start"
                                             alt="{{$movie->image}}">
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

                                                <div class="col col-3">
                                                    <a data-bs-toggle="modal" data-bs-target="#moviesEDIT{{$movie->id}}"
                                                       class="btn btn-success btn-lg ">Edytuj</a>
                                                    <div class="modal fade" id="moviesEDIT{{$movie->id}}" tabindex="-1"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form method="POST" action="{{route('movies.update',[$movie])}}">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Dodaj film</h5>
                                                                        <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                    </div>
                                                                    <div
                                                                        class="modal-body align-items-center justify-content-evenly">
                                                                        <input value="{{$movie->title}}" class="form-control mb-1" type="text"
                                                                               name="title" placeholder="Tytuł filmu">
                                                                        <textarea class="form-control mb-1" rows="4"
                                                                                  name="description"
                                                                                  placeholder="Opis filmu">{{$movie->description}}</textarea>
                                                                        <div class="input-group mb-1">
                                                                            <input value="{{$movie->image}}" type="text" class="form-control"
                                                                                   name="image" placeholder="img"
                                                                                   aria-label="img"
                                                                                   aria-describedby="basic-addon1">
                                                                            <input value="{{$movie->director}}" type="text" class="form-control"
                                                                                   name="director"
                                                                                   placeholder="Reżyseria"
                                                                                   aria-label="Reżyseria"
                                                                                   aria-describedby="basic-addon1">
                                                                        </div>
                                                                        <input class="form-control mb-1" value="{{$movie->actors}}" type="text"
                                                                               name="actors" placeholder="Aktorzy">
                                                                        <div class="input-group mb-1">
                                                                            <input value="{{$movie->duration}}" type="text" class="form-control"
                                                                                   name="duration"
                                                                                   placeholder="Czas trwania"
                                                                                   aria-label="Czas trwania"
                                                                                   aria-describedby="basic-addon1">
                                                                            <input type="text" value="{{$movie->score}}" class="form-control"
                                                                                   name="score"
                                                                                   placeholder="Ocena (1-10)"
                                                                                   aria-label="Ocena"
                                                                                   aria-describedby="basic-addon1">
                                                                        </div>
                                                                        {{--here--}}
                                                                        <div class="mb-1">
                                                                            <label class="form-label">Gatunki filmu:</label>
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    @foreach ($genres->slice(0, $genres->count()/2) as $genre)
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" type="checkbox" name="genres[]" value="{{ $genre->id }}" id="genre{{ $genre->id }}"
                                                                                                   @if($movie->genre->contains($genre->id)) checked @endif>
                                                                                            <label class="form-check-label" for="genre{{ $genre->id }}">
                                                                                                {{ $genre->name }}
                                                                                            </label>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                                <div class="col">
                                                                                    @foreach ($genres->slice($genres->count()/2) as $genre)
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" type="checkbox" name="genres[]" value="{{ $genre->id }}" id="genre{{ $genre->id }}"
                                                                                                   @if($movie->genre->contains($genre->id)) checked @endif>
                                                                                            <label class="form-check-label" for="genre{{ $genre->id }}">
                                                                                                {{ $genre->name }}
                                                                                            </label>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
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

                                                <div class="col col-3">
                                                    <form method="POST" action="{{ route('movies.destroy',[$movie]) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-lg " type="submit">Usuń
                                                        </button>
                                                    </form>
                                                </div>

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

<div class="row">
    <div class="col text-center">
        <a data-bs-toggle="modal" data-bs-target="#moviesADD"
           class="btn btn-primary btn-lg ">Dodaj film</a>
        <div class="modal fade" id="moviesADD" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{route('movies.store')}}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Dodaj film</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body align-items-center justify-content-evenly">
                            <input class="form-control mb-1" type="text" name="title" placeholder="Tytuł filmu">
                            <textarea class="form-control mb-1" rows="4" name="description"
                                      placeholder="Opis filmu"></textarea>
                            <div class="input-group mb-1">
                                <input type="text" class="form-control" name="image" placeholder="img" aria-label="img"
                                       aria-describedby="basic-addon1">
                                <input type="text" class="form-control" name="director" placeholder="Reżyseria"
                                       aria-label="Reżyseria" aria-describedby="basic-addon1">
                            </div>
                            <input class="form-control mb-1" type="text" name="actors" placeholder="Aktorzy">
                            <div class="input-group mb-1">
                                <input type="text" class="form-control" name="duration" placeholder="Czas trwania"
                                       aria-label="Czas trwania" aria-describedby="basic-addon1">
                                <input type="text" class="form-control" name="score" placeholder="Ocena (1-10)"
                                       aria-label="Ocena" aria-describedby="basic-addon1">
                            </div>
                            {{--here--}}
                            <div class="mb-1">
                                <label class="form-label">Gatunki filmu:</label>
                                <div class="row">
                                    <div class="col">
                                        @foreach ($genres->slice(0, $genres->count()/2) as $genre)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="genres[]"
                                                       value="{{ $genre->id }}" id="genre{{ $genre->id }}">
                                                <label class="form-check-label" for="genre{{ $genre->id }}">
                                                    {{ $genre->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col">
                                        @foreach ($genres->slice($genres->count()/2) as $genre)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="genres[]"
                                                       value="{{ $genre->id }}" id="genre{{ $genre->id }}">
                                                <label class="form-check-label" for="genre{{ $genre->id }}">
                                                    {{ $genre->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Zapisz</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>


@include('shared\footer')
<script src="{{ asset('js/bootstrap.bundle.js') }}"></script>

</body>
</html>
