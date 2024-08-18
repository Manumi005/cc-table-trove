<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-Order Summary</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
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
