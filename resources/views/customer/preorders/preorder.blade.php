<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-Order</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 30px;
            text-align: center;
            color: #343a40;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
            background-color: #f8f9fa;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #dee2e6;
        }

        th {
            background-color: #343a40;
            color: #fff;
        }

        td {
            background-color: #ffffff;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-success {
            background-color: #28a745;
            color: #fff;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .totals {
            font-size: 1.5rem;
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            color: #343a40;
        }

        .totals h3 {
            margin: 0;
        }

        .submit-container {
            text-align: center;
            margin-top: 30px;
        }

        .add-more-items-container {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Pre-Order Items</h1>
        <div class="add-more-items-container">
            <a href="{{ url('/customer/restaurant/menu') }}">View Menu</a>
            <a href="{{ route('customer.reservations.index') }}" class="btn btn-primary ml-2">View Reservations</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="preorder-items">
                <!-- Pre-order items will be dynamically inserted here -->
            </tbody>
        </table>
        <div class="totals">
            <h3>Total Price: Rs. <span id="total-price">0.00</span></h3>
        </div>
        <div class="submit-container">
            <button class="btn btn-success" onclick="submitPreOrder()">Submit Pre-Order</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            updatePreOrderItems();
        });

        function updatePreOrderItems() {
            const preOrderItems = JSON.parse(localStorage.getItem('preOrderItems')) || [];
            const preorderItemsContainer = document.getElementById('preorder-items');
            const totalPriceElement = document.getElementById('total-price');

            preorderItemsContainer.innerHTML = '';
            let totalPrice = 0;

            preOrderItems.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.name}</td>
                    <td>Rs. ${parseFloat(item.price).toFixed(2)}</td>
                    <td>${item.quantity}</td>
                    <td>Rs. ${(item.price * item.quantity).toFixed(2)}</td>
                `;
                preorderItemsContainer.appendChild(row);

                totalPrice += item.price * item.quantity;
            });

            totalPriceElement.textContent = totalPrice.toFixed(2);
        }

        function submitPreOrder() {
            const preOrderItems = JSON.parse(localStorage.getItem('preOrderItems')) || [];

            // Validation: Check if pre-order items are empty
            if (preOrderItems.length === 0) {
                alert('No items in the pre-order. Please add items before submitting.');
                return;
            }

            fetch('{{ route('preorder.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ preorder_items: preOrderItems })
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                console.log('Data:', data);
                if (data.success) {
                    alert('Pre-Order submitted successfully!');
                    localStorage.removeItem('preOrderItems');
                    location.reload();
                } else {
                    alert('Failed to submit pre-order.');
                    console.error('Server response:', data);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while submitting the pre-order. Check console for details.');
            });
        }
    </script>
</body>

</html>