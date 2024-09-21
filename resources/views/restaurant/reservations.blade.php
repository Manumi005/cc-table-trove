<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
            -webkit-transition: width 0.3s ease;
        }
        nav ul li a:hover::after {
            width: 100%;
            left: 0;
            background-color: #fff;
        }
        .search-bar {
            display: flex;
            align-items: right;
            flex-grow: 1;
            justify-content: right;
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
            margin-right: 20px;
            cursor: pointer;
        }
        .profile-icon img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }
        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: #b7d3ee;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 60px;
            margin-top: -90px
        }
        .reserve-icon {
            width: 80px; /* Adjust size as needed */
            height: auto;
            margin: 30px;
            margin-left: 300px;

        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-radius: 20px;
        }
        .table th{
            padding: 10px;
            border: 1px solid #333;
            background-color: #4984ac;
            text-align: center;
            color: #333;
        }


        .table td {
            padding: 10px;
            border: 1px solid #333;
            background-color: #ddefff;
            text-align: center;
        }
        .badge-warning { background-color: #ffc107; }
        .badge-success { background-color: #28a745; }
        .badge-danger { background-color: #dc3545; }
        .btn {
            display: inline-block;
            padding: 20px ;
            margin: 5px;
            color: #fff;
            background-color: #568e7a;
            text-decoration: none;
            border-radius: 100px;
            border: 1px solid #333;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
                .bg-warning {
            background-color: #ffc107 !important;
        }

        .bg-success {
            background-color: #28a745 !important;
        }

        .bg-danger {
            background-color: #dc3545 !important;
        }

        .text-dark {
            color: #000 !important;
        }

        .text-white {
            color: #fff !important;
        }
        .btn-success { background-color: #28a745; }
        .btn-success { background-color: #28a745; }
        .btn-danger { background-color: #dc3545; }
        .btn-warning { background-color: #ffc107; }
        .btn-primary { background-color: #c19a6b; }
        .btn-primary1 { background-color: #d98cb3; }
        .btn:hover {
            background-color: #248958;
        }
        .btn-success:hover { background-color: #218838; }
        .btn-danger:hover { background-color: #c82333; }
        .btn-warning:hover { background-color: #e0a800; }
        .btn-primary:hover { background-color: #b86b45; }
        .btn-primary1:hover { background-color: #c072a4; }
    </style>
</head>
<header>
    <nav>
        <img src="{{ asset('images/logo.png') }}" alt="Logo" onclick="location.href='/restaurant/dashboard'">
        <ul>
            <li><a href='/restaurant/menu'>Menu Management</a></li>
            <li><a href="/restaurant/reservations">Reservation Management</a></li>
{{--            <li><a href='/pre-order'>Pre-Order Management</a></li>--}}
            <li><a href='/payment-verification'>Payment Verification</a></li>
            <li><a href='/restaurant/offers'>Offers Management</a></li>
        </ul>
    </nav>
    <div class="search-bar">
        <input type="text" placeholder="Search...">
        <div class="profile-icon" onclick="location.href='/restaurant/profile'">
            <img src="{{ asset('images/restaurant.png') }}" alt="Profile">
        </div>
    </div>
</header>
<body>
<div id="app">
    <!-- Main Content Area -->
    <div class="container mt-4">
        <img src="{{ asset('images/restaurantreservation.png') }}" alt="reserve Icon" class="reserve-icon">

        <h1>Reservations</h1>

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Customer Name</th>
                <th>Reservation Date</th>
                <th>Time Slot</th>
                <th>Party Size</th>
                <th>Special Requests</th>
                <th>Pre-Orders</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->customer->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d') }}</td>
                    <td>{{ $reservation->time_slot }}</td>
                    <td>{{ $reservation->party_size }}</td>
                    <td>
                        <a href="{{ route('restaurant.customizations', $reservation->id) }}" class="btn btn-primary">View</a>
                    </td>
                    <td>
                        <a href ="{{ route('restaurant.preorders.index', ['reservation' => $reservation->id]) }}" class="btn btn-primary1">View</a>
                    </td>
                    <td class="
                                @if($reservation->status == 'Pending') bg-warning text-dark
                                @elseif($reservation->status == 'Approved') bg-success text-white
                                @elseif($reservation->status == 'Cancelled') bg-danger text-white
                                @endif
                            ">
                        {{ $reservation->status }}
                    </td>
                    <td>
                        @if($reservation->status == 'Pending')
                            <form action="{{ route('restaurant.reservation.approve', $reservation->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to approve this reservation?');">
                                @csrf
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                            <form action="{{ route('restaurant.reservation.cancel', $reservation->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                                @csrf
                                <button type="submit" class="btn btn-danger">Cancel</button>
                            </form>
                        @endif
                        <form action="{{ route('restaurant.reservation.destroy', $reservation->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this reservation?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-warning">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
