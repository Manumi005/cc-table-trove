<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Verification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 30px;
            max-width: 800px;
            margin: auto;
            margin-top: 50px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        h2 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        .payment-details {
            margin-top: 20px;
        }

        .payment-details p {
            font-size: 1.2rem;
            color: #333;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-weight: bold;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin-top: 20px;
            }

            h2 {
                font-size: 1.5rem;
            }

            .payment-details p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Payment Verification</h2>
        <div class="payment-details">
            <p><strong>Order ID:</strong> {{ $order->id }}</p>
            <p><strong>Customer Name:</strong> {{ $order->customer_name }}</p>
            <p><strong>Payment Status:</strong> {{ $order->payment_status }}</p>
            <p><strong>Total Amount:</strong> Rs. {{ number_format($order->total_amount, 2) }}</p>
        </div>
        <form action="{{ route('order.approve') }}" method="POST">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <button type="submit" class="btn btn-success">Approve Payment</button>
        </form>
        <form action="{{ route('order.cancel') }}" method="POST" class="mt-3">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <button type="submit" class="btn btn-danger">Cancel Payment</button>
        </form>
    </div>
</body>
</html>