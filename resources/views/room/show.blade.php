<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $showtime->show->movie->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/tempusdominus-bootstrap-4@5.39.0/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    @vite([ 'resources/css/app.css','public/css/bootstrap.css','resources/js/app.js','public/js/bootstrap.bundle.js'])
</head>
<body class="bg-p_primary-400 md:text-lg">
@include('layouts.navigation')
<div class="flex justify-content-center">
    <div class="row mt-3 max-w-4xl">
        <div class="col col-11 mx-auto mt-3">
            <h4 class="text-p_accent-500 mb-4">Dostępne miejsca</h4>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}aaa
                </div>
            @endif
            <div class="bg-p_primary-600 w-100 h-10 fw-bold fs-2 text-p_support-50 text-center">Ekran</div>

            <table class="table mt-2 table-borderless">
                @for ($i = 1; $i <= $room->rows; $i++)
                    <tr>
                        <td class="text-white">{{ $i }}</td>
                        @for ($j = 1; $j <= $room->cols; $j++)
                            @php
                                $canMake = true;
                            @endphp
                            @foreach ($tickets as $ticket)
                                @if ($ticket->row===$i && $ticket->seat===$j && $ticket->status =="paid")
                                <td><button class="btn text-white bg-danger" disabled onclick="toggleSelected(this)" data-row="{{ $i }}"
                                    data-col="{{ $j }}">{{$j}}</button></td>
                                    @php
                                        $canMake=false;
                                    @endphp
                                @endif
                            @endforeach
                                @if ($canMake)
                                <td><button class="btn btn-outline-light text-white" onclick="toggleSelected(this)" data-row="{{ $i }}"
                                    data-col="{{ $j }}">{{$j}}</button></td>
                                @endif
                        @endfor
                    </tr>
                @endfor
            </table>
        </div>
        <div class="col col-11 mb-5 mx-4">
            <div class="row">
                <div class="col col-6">
                    <div>
                        <h4 class="text-p_support-50">Wybrane bilety: <span id="iloscBilety">0</span></h4>
                    </div>
                </div>
                <div class="col col-6">
                    <x-primary-button style="float: right;" data-bs-toggle="modal" data-bs-target="#modalTickets"
                        onclick="populateModal()">Kup bilety</x-primary-button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalTickets" tabindex="-1" aria-labelledby="modalTicketsLabel" aria-hidden="true">
    <div class="modal-dialog bg-p_primary-500 ">
        <div class="modal-content bg-transparent text-p_support-50">
            <div class="modal-header border-b border-0">
                <h5 class="modal-title text-p_support-50" id="modalTicketsLabel">Wybrane bilety</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col text-p_support-50">Seat</div>
                        <div class="col text-p_support-50">Ticket Type</div>
                    </div>
                    <!-- The selected seats will be dynamically populated here -->
                </div>
            </div>
            <div class="modal-footer border-0">
<!--
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Zamknij</button>
-->
                @if(\Illuminate\Support\Facades\Auth::user())
                    <x-primary-button type="button" id="paybutton" onclick="createTickets()">Do płatności</x-primary-button>
                @else
                    <span class="text-p_accent-600 fw-bold fs-3" >Aby kupic bilet należy się zalogować</span>
                @endif

            </div>
        </div>
    </div>
</div>


@include('shared/polecamy')

    @include('shared\footer')
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script>
            var selectedSeats = [];

        function toggleSelected(button) {
            var row = button.dataset.row;
            var col = button.dataset.col;

            if (button.classList.contains('btn-success')) {
                button.classList.remove('btn-success');
                removeSelectedSeat(row, col); // Remove the seat from the selectedSeats array
            } else {
                button.classList.add('btn-success');
                addSelectedSeat(row, col); // Add the seat to the selectedSeats array
            }
            updateCounter();
        }

        function addSelectedSeat(row, col) {
            selectedSeats.push({
                row: row,
                col: col
            });
        }

        function removeSelectedSeat(row, col) {
            selectedSeats = selectedSeats.filter(function(seat) {
                return !(seat.row === row && seat.col === col);
            });
        }

        function populateModal() {
            var modalBody = document.querySelector('#modalTickets .modal-body');
            modalBody.innerHTML = ''; // Clear the modal body

            selectedSeats.forEach(function(seat) {
                var row = seat.row;
                var col = seat.col;

                // Create a new row element
                var rowElement = document.createElement('div');
                rowElement.classList.add('row');

                // Create the seat column
                var seatCol = document.createElement('div');
                seatCol.classList.add('col');
                seatCol.textContent = 'Seat: Row ' + row + ', Col ' + col;

                // Create the ticket type column with a select box
                var ticketTypeCol = document.createElement('div');
                ticketTypeCol.classList.add('col');
                seatCol.classList.add('text-p_support-50');

                var ticketTypeSelect = document.createElement('select');
                ticketTypeSelect.classList.add('form-select');
                ticketTypeSelect.id = 'ticketType-' + row + '-' + col;
                ticketTypeSelect.innerHTML =
                    '<option value="normalny">Normalny</option><option value="ulgowy">Ulgowy</option>';

                // Append the ticketTypeSelect to the ticketTypeCol
                ticketTypeCol.appendChild(ticketTypeSelect);

                // Append the seat column and ticket type column to the row element
                rowElement.appendChild(seatCol);
                rowElement.appendChild(ticketTypeCol);

                modalBody.appendChild(rowElement); // Add the row element to the modal body
            });
        }

        function updateCounter() {
            var selectedButtons = document.querySelectorAll('.btn-success');
            var counter = document.getElementById('iloscBilety');
            counter.textContent = selectedButtons.length ;
        }

        function createTickets() {
            var paybutton = document.getElementById('paybutton');
            paybutton.disabled = true;
            var amount = 0;
            var showDate = new Date("{{ $showtime->show->date }}");
            var today = new Date();
            today.setHours(0, 0, 0, 0);
            var daysAhead = Math.floor((showDate - today) / (1000 * 60 * 60 * 24));

            var discountPercentage = Math.min(daysAhead * 5, 20);

            selectedSeats.forEach(function(seat) {
                var row = seat.row;
                var col = seat.col;
                var ticketTypeSelect = document.querySelector('#ticketType-' + row + '-' + col);
                var ticketType = ticketTypeSelect.value;
                var price = 0;

                if (ticketType === 'normalny') {
                    price = 10;
                } else if (ticketType === 'ulgowy') {
                    price = 5;
                }

                price = price * (1 - discountPercentage / 100);

                amount += price;

                var showtime_id = "{{ $showtime->id }}";

                var formData = new FormData();
                formData.append('row', row);
                formData.append('seat', col);
                formData.append('price', price);
                formData.append('showtime_id', showtime_id);
                @if(Auth::user())//TODO: zdecydowac czy kupowanie biletu bedzie tylko dla zalogowanych uzytkowników
                formData.append('user_id', "{{ Auth::user()->id }}");
                @else

                @endif

                console.warn('aaaa');

                var request = new XMLHttpRequest();
                request.open('POST', "{{ route('tickets.store') }}");
                request.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                request.send(formData);
            });


            {{--var formData2 = new FormData();--}}
            {{--formData2.append('amount', amount);--}}
            {{--var request = new XMLHttpRequest();--}}
            {{--request.open('POST', "{{ route('pay') }}");--}}
            {{--request.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');--}}
            {{--request.onload = function() {--}}
            {{--    if (request.status === 200) {--}}
            {{--        console.log('Ticket created successfully.');--}}
            {{--    } else {--}}
            {{--        console.error('Failed to create ticket.');--}}
            {{--    }--}}
            {{--};--}}
            {{--request.send(formData2);--}}
            {{--window.location.href = "{{ route('payment',['id'=>1]) }}";--}}
            var formData2 = new FormData();
            formData2.append('amount', amount*100);
            var request = new XMLHttpRequest();
            request.open('POST', "{{ route('pay') }}");
            request.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            request.onload = function() {
                if (request.status === 200) {
                    var response = JSON.parse(request.response);
                    console.log('Payment intent created successfully.');
                    console.log(response);

                    window.location.href = response.url;
                    //var clientSecret = response.client_secret;
//                    var paymentId = response.payment_id;

                } else {
                    console.error('Failed to create payment intent.');
                }
            };
            request.send(formData2);

        }


    </script>
</body>

</html>
