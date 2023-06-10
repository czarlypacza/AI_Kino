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
    <style>
        .p_primary-text {
            color: #212121;
        }

        .p_primary-bg {
            background-color: #212121;
        }

        .p_primary-border {
            border: 1px solid #212121;
        }
        .p_secondary-text {
            color: #181818;
        }
        .accordion-button:focus {
            z-index: 3;
            border-color: #181818;
            outline: 0;
            box-shadow: var(--bs-accordion-btn-focus-box-shadow);
        }
        .accordion-button:not(.collapsed) {
            color: #14FFEC;
            background-color: #181818;
            box-shadow: inset 0 calc(-1 * var(--bs-accordion-border-width)) 0 var(--bs-accordion-border-color);
        }
        .accordion-button {
            color: #11CCBE;
        }
        .accordion-item {
            border: var(--bs-accordion-border-width) solid #2A8587;
        }
    </style>
</head>

<body class="bg-p_primary-400">
@include('layouts.navigation')
<div class="row w-100 mt-3 bg-p_primary-400">
    <div class="col-11 col-lg-10 col-xl-9 mt-3 mx-auto">
        <h3 class="text-p_support-50">Sale</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-p_support-50">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="accordion accordion-flush bg-p_primary-500 border-b border-t border-p_accent-900" id="accordionRooms">
            @foreach($rooms as $room)
                <div class="accordion-item bg-p_primary-500 border-b border-t border-p_accent-900">
                    <h2 class="accordion-header text-p_support-50" id="flush-headingOne">
                        <button class="accordion-button collapsed p_primary-bg text-p_support-50" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne{{$room->id}}" aria-expanded="false"
                                aria-controls="flush-collapseOne">
                            Room: {{ $room->id }}
                        </button>
                    </h2>
                    <div id="flush-collapseOne{{$room->id}}" class="accordion-collapse collapse bg-p_primary-500 border-b border-t border-p_accent-900"
                         aria-labelledby="flush-headingOne" data-bs-parent="#accordionRooms">
                        <div class="accordion-body bg-p_primary-500 text-p_support-50">

                            <div class="row mb-3 bg-p_primary-500">
                                <div class="col col-6 text-center md:text-lg">Rows: {{ $room->rows }}</div>
                                <div class="col col-6 text-center md:text-lg">Columns: {{ $room->cols }}</div>
                            </div>
                            <div class="row d-flex justify-content-around bg-p_primary-500">
                                <div class="col col-3 text-center md:text-lg">
                                    <a data-bs-toggle="modal" data-bs-target="#roomsEDIT{{$room->id}}"
                                       class="btn btn-success">Edit</a>
                                    <div class="modal fade bg-transparent" id="roomsEDIT{{$room->id}}" tabindex="-1"
                                         aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content p_primary-bg rounded-2">
                                                <form method="POST" action="{{route('rooms.update',[$room])}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header bg-p_primary-500">
                                                        <h5 class="modal-title text-p_support-50" id="exampleModalLabel">
                                                            Edit room</h5>
                                                        <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body align-items-center justify-content-evenly bg-p_primary-500 text-p_support-50 border-b border-t border-p_accent-900">
                                                        <div class="input-group mb-1">
                                                            <input value="{{$room->rows}}" type="text" class="form-control"
                                                                   name="rows" placeholder="Rows"
                                                                   aria-label="Rows"
                                                                   aria-describedby="basic-addon1">
                                                            <input value="{{$room->cols}}" type="text" class="form-control"
                                                                   name="cols" placeholder="Columns"
                                                                   aria-label="Columns"
                                                                   aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer bg-p_primary-500">
                                                        <button type="submit" class="btn btn-primary">
                                                            Save
                                                        </button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col col-3 text-center md:text-lg">
                                    <form method="POST" action="{{ route('rooms.destroy',[$room]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        <div class="row my-3">
    <div class="col text-center text-p_accent-600">
        <x-primary-button data-bs-toggle="modal" data-bs-target="#roomsADD">Dodaj sale</x-primary-button>
        <div class="modal fade" id="roomsADD" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content p_primary-bg">
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
