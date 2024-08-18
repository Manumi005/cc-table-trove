<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-Order Summary</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
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

        table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            text-align: center;
            padding: 15px;
            border: 1px solid #ddd;
        }

        table thead {
            background-color: #d63f77;
            color: white;
        }

        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tbody tr:hover {
            background-color: #e0e0e0;
        }

        #totalAmount {
            font-size: 1.5rem;
            color: #333;
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
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

            table th, table td {
                padding: 10px;
            }

            #totalAmount {
                font-size: 1.25rem;
            }
        }
    </style>

    </style>
    </style>
<body>
    <div class="container mt-5">
        <h2>Pre-Order Summary</h2>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="preOrderSummaryTable">
                <!-- Pre-order items will be dynamically populated here -->
            </tbody>
        </table>
        <div id="totalAmount" class="mt-3">
            <strong>Total Amount: Rs. 0.00</strong>
        </div>
        <a href="{{ route('payment') }}" class="btn btn-primary mt-3">Proceed to Payment</a>
    </div>

    <script>
        function displayPreOrderSummary() {
            const preOrderItems = JSON.parse(localStorage.getItem('preOrderItems')) || [];
            const preOrderSummaryTable = document.getElementById('preOrderSummaryTable');
            let totalAmount = 0;

            preOrderItems.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.name}</td>
                    <td>Rs. ${parseFloat(item.price).toFixed(2)}</td>
                    <td>${item.quantity}</td>
                    <td>Rs. ${(item.quantity * item.price).toFixed(2)}</td>
                `;
                preOrderSummaryTable.appendChild(row);

                totalAmount += item.quantity * item.price;
            });

            document.getElementById('totalAmount').innerHTML = `<strong>Total Amount: Rs. ${totalAmount.toFixed(2)}</strong>`;
        }

        // Call the function on page load to display pre-order summary
        displayPreOrderSummary();
    </script>
</body>
</html>