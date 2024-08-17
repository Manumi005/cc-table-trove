<!-- preorder.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-Order</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Inline styles here */
    </style>
</head>
<body>
    <div class="container">
        <h1>Pre-Order Items</h1>
        <div class="add-more-items-container">
            <a href="{{ url('/customer/restaurant/menu') }}">View Menu</a>
            <a href="{{ route('customer.reservations.index') }}" class="btn btn-primary ml-2">View Reservations</a>
        </div>
        <form id="preorder-form" action="{{ route('preorder.summary') }}" method="POST">
            @csrf
            <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
            <input type="hidden" name="reservation_date" value="{{ $reservation->reservation_date }}">
            <input type="hidden" name="reservation_time" value="{{ $reservation->time_slot }}">
            <input type="hidden" name="reservation_guests" value="{{ $reservation->party_size }}">
            <input type="hidden" name="reservation_restaurant" value="{{ $reservation->restaurant->name }}">
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
                <button type="submit" class="btn btn-success">Submit Pre-Order</button>
            </div>
        </form>
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
                    <input type="hidden" name="preorder_items[]" value='${JSON.stringify(item)}'>
                `;
                preorderItemsContainer.appendChild(row);

                totalPrice += item.price * item.quantity;
            });

            totalPriceElement.textContent = totalPrice.toFixed(2);
        }
    </script>
</body>
</html>