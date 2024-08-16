<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .table th, .table td {
            text-align: center;
        }
        .btn {
            margin: 0 5px;
        }
        .badge-warning { background-color: #ffc107; }
        .badge-success { background-color: #28a745; }
        .badge-danger { background-color: #dc3545; }
        .btn-success, .btn-danger, .btn-warning {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div id="app">
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
            <!-- Add more navigation items if needed -->
        </nav>

        <!-- Main Content Area -->
        <div class="container mt-4">
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
                                @if($reservation->status == 'Pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($reservation->status == 'Approved')
                                    <span class="badge badge-success">Approved</span>
                                @elseif($reservation->status == 'Cancelled')
                                    <span class="badge badge-danger">Cancelled</span>
                                @endif
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
