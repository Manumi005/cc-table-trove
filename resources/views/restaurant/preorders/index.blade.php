<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('{{ asset('images/wallpaper3.jpg') }}') no-repeat center center fixed;
            margin: 0;
            padding: 0;
            background-color: #98b2b8;
        }

        .container {
            padding: 20px;
            max-width: 1200px;
            margin: auto;
            margin-top: 50px;
            background-color:#b86a8f;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .restaurant-info {
            margin-bottom: 30px;
            text-align: center;
        }

        .restaurant-info h2 {
            font-size: 2rem;
            color: #333;
        }

        .media img {
            width: 64px;
            height: 64px;
            margin-right: 20px;
            object-fit: cover;
        }

        .media-body {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .order-icon {
            cursor: pointer;
            color: #d63f77;
            font-size: 1.2rem;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .preorder-summary table {
            border-collapse: collapse; /* Ensures borders don't have gaps */
        }

        .preorder-summary table,
        .preorder-summary table th,
        .preorder-summary table td {
            border: 1px solid black; /* Sets the border color to black */
        }

        .preorder-summary table th {
            text-align: center;
            background-color: #d63f77 !important; /* Dark pink color with higher priority */
            color: #fff !important;
        }

        .preorder-summary table td {
            text-align: center;
            background-color: #fdd8e9;
        }

        .fixed-bottom-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000; /* Ensure the button is above other content */
        }

        .btn-primary {
            background-color: #d63f77;
            border-color: #d63f77;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-submit {
            background-color: #715193;
            border-color: #4b0082;
            color: #fff;
            font-weight: bold;
            transition: background-color 0.3s ease;
            position: relative;
            margin-top: 20px;
            transtion: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #3e0074;
            color: #fff;
            border-color: #3e0074;
        }

        .fixed-bottom-btn {
            display: none;
        }


        .btn-primary:hover {
            background-color: #b83a6b;
            border-color: #b83a6b;
        }

        .btn-secondary {
            background-color: #568e7a;
            border-color: #568e7a;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #218838;
        }

        #total-summary {
            font-size: 1.5rem;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>
<body>
<main class="container">
    <div class="restaurant-info">
        <h1 id="restaurant-name">Pre-Order Summary</h1>
    </div>

    <ul id="menu-list" class="list-unstyled">
        <!-- Menu items will be dynamically populated here -->
    </ul>

    <div id="quantity-modal" class="modal">
        <div class="modal-content">
            <h3>Add to Pre-Order</h3>
            <p id="modal-warning" style="color: red; display: none;">You can only add items from the selected restaurant.</p>
            <input type="number" id="quantity-input" min="1" value="1" class="form-control mb-3">
            <button onclick="addToPreOrder()" class="btn btn-primary">Add to Pre-Order</button>
            <button onclick="closeQuantityModal()" class="btn btn-secondary">Cancel</button>
        </div>
    </div>

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
            <tbody id="preorder-list">
            @forelse ($preorders as $preorder)
                <tr>
                    <td>{{ $preorder->menu->name }}</td>
                    <td>Rs. {{ number_format($preorder->menu->price, 2) }}</td>
                    <td>{{ $preorder->quantity }}</td>
                    <td>Rs. {{ number_format($preorder->quantity * $preorder->menu->price, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No items in pre-order.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div id="total-summary" class="mt-3">
            <strong>Total: Rs. {{ number_format($preorders->sum(fn($preorder) => $preorder->quantity * $preorder->menu->price), 2) }}</strong>
        </div>
    </div>
    <a href="/restaurant/reservations" class="btn btn-primary ml-2">Return to Reservation Management</a>
</main>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function adjustQuantity(id) {
        const newQuantity = prompt('Enter new quantity:');
        if (newQuantity !== null && newQuantity > 0) {
            $.ajax({
                url: `/preorders/${id}/adjust-quantity`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    quantity: newQuantity,
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        location.reload(); // Refresh the page to reflect the changes
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Error adjusting quantity.');
                }
            });
        } else {
            alert('Please enter a valid quantity.');
        }
    }

    function deleteItem(id) {
        if (confirm('Are you sure you want to remove this item?')) {
            $.ajax({
                url: `/preorders/${id}`,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        location.reload(); // Refresh the page to reflect the changes
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Error removing item.');
                }
            });
        }
    }

    function returnToMenu() {
        const ordermenuUrl = "{{ route('customer.menu.ordermenu', ['restaurantId' => $reservation->restaurant->id, 'reservationId' => $reservation->id]) }}";
        window.location.href = ordermenuUrl;
    }
</script>
</body>
</html>
