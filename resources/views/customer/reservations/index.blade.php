<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Reservations</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #343a40;
        }
        .table {
            margin-top: 20px;
        }
        .table th {
            background-color: #007bff;
            color: #fff;
        }
        .btn {
            padding: 5px 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #c82333;
        }
        .alert {
            margin-top: 20px;
        }
        .reservation-details {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Your Reservations</h1>
        
        <!-- Display success message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Display error messages -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Check if there are no reservations -->
        @if($reservations->isEmpty())
            <div class="alert alert-info">
                You have no reservations yet. <a href="{{ route('customer.reservations.create') }}" class="btn btn-primary ml-2">Make a New Reservation</a>
            </div>
        @else
            <!-- Reservations table -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Restaurant</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Guests</th>
                        <th>Status</th>
                        <th>Actions</th>
                        <th>Pre-Order</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->restaurant->name }}</td>
                            <td>{{ $reservation->reservation_date }}</td>
                            <td>{{ $reservation->time_slot }}</td>
                            <td>{{ $reservation->party_size }}</td>
                            <td>{{ $reservation->status }}</td>
                            <td>
                                <!-- Cancel reservation button -->
                                <form action="{{ route('customer.reservations.destroy', $reservation->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this reservation?')">Cancel</button>
                                </form>
                                <!-- Show reservation details within the same page -->
                                <button class="btn btn-info reservation-details" data-toggle="modal" data-target="#reservationModal" data-id="{{ $reservation->id }}" data-restaurant="{{ $reservation->restaurant->name }}" data-date="{{ $reservation->reservation_date }}" data-time="{{ $reservation->time_slot }}" data-guests="{{ $reservation->party_size }}" data-status="{{ $reservation->status }}">Details</button>
                            </td>
                            <td>
                                @if($reservation->status == 'Approved')
                                    <a href="{{ route('customer.restaurant.menu', $reservation->restaurant->id) }}" class="btn btn-primary">Pre-Order</a>
                                @else
                                    <span class="text-muted">Not Available</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <!-- Link to create a new reservation -->
        <a href="{{ route('customer.reservation.create') }}" class="btn btn-primary ml-2">Make a New Reservation</a>
    </div>

    <!-- Reservation Details Modal -->
    <div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="reservationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reservationModalLabel">Reservation Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Restaurant:</strong> <span id="reservationRestaurant"></span></p>
                    <p><strong>Date:</strong> <span id="reservationDate"></span></p>
                    <p><strong>Time:</strong> <span id="reservationTime"></span></p>
                    <p><strong>Guests:</strong> <span id="reservationGuests"></span></p>
                    <p><strong>Status:</strong> <span id="reservationStatus"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // JavaScript to handle the modal data population
        $(document).ready(function() {
            $('#reservationModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var id = button.data('id'); // Extract info from data-* attributes
                var restaurant = button.data('restaurant');
                var date = button.data('date');
                var time = button.data('time');
                var guests = button.data('guests');
                var status = button.data('status');
                
                var modal = $(this);
                modal.find('#reservationRestaurant').text(restaurant);
                modal.find('#reservationDate').text(date);
                modal.find('#reservationTime').text(time);
                modal.find('#reservationGuests').text(guests);
                modal.find('#reservationStatus').text(status);
            });
        });
    </script>
</body>
</html>
