<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('{{ asset('images/wallpaper2.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 30px;
            max-width: 800px;
            margin: auto;
            margin-top: 50px;
            background-color: #f7f7f7;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            opacity: 0.95;
        }

        h2 {
            font-size: 2rem;
            color: #d63f77;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        .summary-details {
            margin-top: 20px;
        }

        .summary-details p {
            font-size: 1.2rem;
            color: #333;
        }

        .btn-primary {
            background-color: #d63f77;
            border-color: #d63f77;
            font-weight: bold;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #b83a6b;
            border-color: #b83a6b;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin-top: 20px;
            }

            h2 {
                font-size: 1.5rem;
            }

            .summary-details p {
                font-size: 1rem;
            }
        }

        .card {
            cursor: pointer;
            margin-top: 20px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .card h3 {
            margin-top: 10px;
            font-size: 1.5rem;
            color: #333;
        }

        .card p {
            font-size: 1rem;
            color: #666;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Order Summary</h2>
    @if (session('message'))
        <div class="alert alert-info text-center">
            {{ session('message') }}
        </div>
    @endif

    <div class="preorder-summary">
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
            @forelse ($preorders as $preorder)
                <tr>
                    <td>{{ $preorder->menu->name }}</td>
                    <td>{{ number_format($preorder->menu->price, 2) }}</td>
                    <td>{{ $preorder->quantity }}</td>
                    <td>{{ number_format($preorder->menu->price * $preorder->quantity, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No items in pre-order.</td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3" class="text-right"><strong>Total Amount:</strong></td>
                <td><strong>{{ number_format($preorders->sum(fn($preorder) => $preorder->quantity * $preorder->menu->price), 2) }}</strong></td>
            </tr>
            </tfoot>
        </table>
    </div>
    <a href="/customer/reservations" class="btn btn-primary ml-2">Return to your Reservations</a>
</div>
</body>
</html>
