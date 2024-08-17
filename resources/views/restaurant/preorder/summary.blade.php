<!-- summary.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-Order Summary</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Inline styles here */
    </style>
</head>
<body>
    <div class="container">
        <h1>Pre-Order Summary</h1>
        <div class="reservation-details">
            <h3>Reservation Details</h3>
            <p><strong>Restaurant:</strong> {{ $reservationDetails['reservation_restaurant'] }}</p>
            <p><strong>Date:</strong> {{ $reservationDetails['reservation_date'] }}</p>
            <p><strong>Time:</strong> {{ $reservationDetails['reservation_time'] }}</p>
            <p><strong>Guests:</strong> {{ $reservationDetails['reservation_guests'] }}</p>
        </div>
        <div class="preorder-items">
            <h3>Pre-Order Items</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($preorderItems as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>Rs. {{ number_format($item['price'], 2) }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>Rs. {{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="totals">
                <h3>Total Price: Rs. {{ number_format(array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, $preorderItems)), 2) }}</h3>
            </div>
        </div>
    </div>
</body>
</html>