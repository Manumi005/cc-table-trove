<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Reservations - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('{{ asset('images/wallpaper3.jpg') }}') no-repeat center center fixed;
            margin: 0;
            padding: 0;
            background-color: #98b2b8;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 60px;
            margin-bottom: 20px;
        }
        nav {
            display: flex;
            align-items: center;
        }
        nav img {
            cursor: pointer;
            width: 150px;
            height: auto;
            margin-right: 20px;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        nav ul li {
            margin: 0 15px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            position: relative;
        }
        nav ul li a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            display: block;
            margin-top: 5px;
            right: 0;
            background: #fff;
            transition: width 0.3s ease;
        }
        nav ul li a:hover::after {
            width: 100%;
            left: 0;
            background-color: #fff;
        }
        .search-bar {
            display: flex;
            align-items: center;
            flex-grow: 1;
            justify-content: flex-end;
            margin: 0 20px;
        }
        .search-bar input {
            padding: 5px 10px;
            font-size: 16px;
            border: none;
            border-radius: 30px;
            width: 100%;
            max-width: 300px;
            background-color: #d9edff;
        }
        .profile-icon {
            margin-left: 15px;
            cursor: pointer;
        }
        .profile-icon img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }

        .header-container {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            margin-left: 50px;
        }
        .header-container img {
            max-width: 50px; /* Adjust size as needed */
            margin-right: 15px;
        }
         .container {
            padding: 20px;
            max-width: 1200px;
            margin: auto;
            background-color: #ffd9f6;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .table {
            margin-top: 20px;
            border-collapse: collapse;
        }
        .table th {
            padding: 10px;
            border: 1px solid #333;
            background-color: #8c6491;
            text-align: center;
            color: #fff;
        }
        .table td {
            padding: 10px;
            border: 1px solid #333;
            background-color: #fdd8e9;
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #568e7a;
            text-decoration: none;
            border-radius: 100px;
            border: 1px solid #333;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-primary {
    background-color: #d63f77; /* Dark pink-purple color */
    border-color: #d63f77;
}

.btn-primary:hover {
    background-color: #b83a6b; /* Slightly darker pink-purple for hover */
    border-color: #b83a6b;
}
.btn-center {
    display: block;
    margin: 20px auto;
    text-align: center;
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
<header>
    <nav>
        <img src="{{ asset('images/logo.png') }}" alt="Logo" onclick="location.href='/customer/dashboard'">
        <ul>
            <li><a href="{{ route('customer.restaurants') }}">Restaurants</a></li>
            <li><a href="{{ route('customer.reservations.index') }}">Reservations</a></li>
            <li><a href="{{ route('customer.offers.index') }}">Offers & Promotions</a></li>
        </ul>
    </nav>
    <div class="search-bar">
        <form method="GET" action="{{ route('customer.restaurants') }}">
            <input type="text" name="query" placeholder="Search..." value="{{ request('query') }}">
        </form>
        <div class="profile-icon" onclick="location.href='/customer/profile'">
            <img src="{{ asset('images/profile.jpg') }}" alt="Profile">
        </div>
    </div>
</header>
<body>

    <div class="container">
    <div class="header-container">
        <img src="{{ asset('images/restaurantreservation.png') }}" alt="Reservation Icon">
        <h1>Your Reservations</h1>
    </div>
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
                You have no reservations yet.
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
                        <th>Special Requests</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->restaurant->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d') }}</td>
                            <td>{{ $reservation->time_slot }}</td>
                            <td>{{ $reservation->party_size }}</td>
                            <td class="
                                @if($reservation->status == 'Pending') bg-warning text-dark
                                @elseif($reservation->status == 'Approved') bg-success text-white
                                @elseif($reservation->status == 'Cancelled') bg-danger text-white
                                @endif
                            ">
                                {{ $reservation->status }}
                            </td>
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
                                    @if($reservation->payment_status == '0')
                                        <a href="{{ route('customer.menu.ordermenu', ['restaurantId' => $reservation->restaurant->id, 'reservationId' => $reservation->id]) }}" class="btn btn-primary">Pre-Order</a>
                                    @else
                                        <a href="{{ route('orderSummary', ['restaurantId' => $reservation->restaurant->id, 'reservationId' => $reservation->id]) }}" class="btn btn-primary">View Summary</a>
                                    @endif

                                @else
                                    <span class="text-muted">Not Available</span>
                                @endif
                            </td>
                            <td>
                                @if($reservation->status == 'Approved')
                                    <a href="{{ route('customer.reservations.customizations.index', ['reservation_id' => $reservation->id]) }}" class="btn btn-primary">Create Customization</a>
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
        <a href="{{ route('customer.reservation.create') }}" class="btn btn-primary btn-center">Make a New Reservation</a>

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
                    <p><strong>Restaurant:</strong> <span id="modalRestaurant"></span></p>
                    <p><strong>Date:</strong> <span id="modalDate"></span></p>
                    <p><strong>Time:</strong> <span id="modalTime"></span></p>
                    <p><strong>Guests:</strong> <span id="modalGuests"></span></p>
                    <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('#reservationModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var restaurant = button.data('restaurant');
            var date = button.data('date');
            var time = button.data('time');
            var guests = button.data('guests');
            var status = button.data('status');

            var modal = $(this);
            modal.find('#modalRestaurant').text(restaurant);
            modal.find('#modalDate').text(date);
            modal.find('#modalTime').text(time);
            modal.find('#modalGuests').text(guests);
            modal.find('#modalStatus').text(status);
        });
    </script>
</body>
</html>
