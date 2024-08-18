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
            <h1 id="restaurant-name">Place your order and enjoy dining </h1>
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
            <h3>Pre-Order Summary</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="preorder-list">
                    <!-- Pre-order items will be dynamically populated here -->
                </tbody>
            </table>
            <div id="total-summary" class="mt-3">
                <strong>Total: Rs. 0.00</strong>
            </div>
        </div>
        <button id="submitPreOrderBtn" class="btn btn-submit" onclick="submitPreOrder()">Submit Pre-Order</button>
    </main>

   

    <script>
    let selectedMenuItem = null;
    let selectedRestaurantId = null;
    let preOrderItems = JSON.parse(localStorage.getItem('preOrderItems')) || [];

    function selectRestaurant(restaurantId, restaurantName) {
        selectedRestaurantId = restaurantId;
        document.getElementById('restaurant-name').innerText = restaurantName;
        updateMenuList([]); // Clear menu list when switching restaurants

        // Fetch menu items for the selected restaurant
        // Example:
        // fetch(`/api/menus?restaurantId=${restaurantId}`)
        //     .then(response => response.json())
        //     .then(data => updateMenuList(data));
    }

    function openQuantityModal(menuItem) {
        if (menuItem.restaurantId !== selectedRestaurantId) {
            document.getElementById('modal-warning').style.display = 'block';
            return;
        }
        document.getElementById('modal-warning').style.display = 'none';
        selectedMenuItem = menuItem;
        document.getElementById('quantity-modal').style.display = 'flex';
    }

    function closeQuantityModal() {
        document.getElementById('quantity-modal').style.display = 'none';
    }

    function addToPreOrder() {
        if (!selectedMenuItem) {
            alert('No menu item selected.');
            return;
        }
        const quantity = parseInt(document.getElementById('quantity-input').value, 10);
        if (quantity <= 0) {
            alert('Please enter a valid quantity.');
            return;
        }

        // Ensure all pre-order items are from the selected restaurant
        if (preOrderItems.length > 0 && preOrderItems[0].restaurantId !== selectedRestaurantId) {
            alert('You can only add items from the selected restaurant.');
            return;
        }

        const existingItemIndex = preOrderItems.findIndex(item => item.id === selectedMenuItem.id);
        if (existingItemIndex >= 0) {
            preOrderItems[existingItemIndex].quantity += quantity;
        } else {
            preOrderItems.push({ ...selectedMenuItem, quantity });
        }

        localStorage.setItem('preOrderItems', JSON.stringify(preOrderItems));
        closeQuantityModal();
        updatePreOrderList();
    }

    function submitPreOrder() {
        const preorderSummaryUrl = "{{ route('preorder.summary') }}";
        window.location.href = preorderSummaryUrl;
    }

    function updateMenuList(menus) {
        const menuList = document.getElementById('menu-list');
        menuList.innerHTML = '';

        menus.forEach(menu => {
            const li = document.createElement('li');
            li.className = 'media mb-3';
            li.innerHTML = `
                <img src="/images/${menu.image}" alt="${menu.name}" class="mr-3">
                <div class="media-body">
                    <h5 class="mt-0 mb-1">${menu.name}</h5>
                    <p class="price">Rs. ${parseFloat(menu.price).toFixed(2)}</p>
                    <p class="category"><strong>Category:</strong> ${menu.category}</p>
                    <p class="allergens"><strong>Allergens:</strong> ${menu.allergens}</p>
                    <p class="dietary"><strong>Dietary Preferences:</strong> ${menu.dietary_preferences}</p>
                    <i class="fas fa-shopping-cart order-icon" onclick='openQuantityModal(${JSON.stringify(menu).replace(/'/g, "\\'")})'></i>
                </div>
            `;
            menuList.appendChild(li);
        });
    }

    function updatePreOrderList() {
        const preorderList = document.getElementById('preorder-list');
        preorderList.innerHTML = '';
        let total = 0;

        if (preOrderItems.length === 0) {
            preorderList.innerHTML = '<tr><td colspan="5">No items in pre-order.</td></tr>';
        } else {
            preOrderItems.forEach(item => {
                const row = document.createElement('tr');
                row.setAttribute('data-id', item.id); // Set a data attribute for easy row access
                row.innerHTML = `
                    <td>${item.name}</td>
                    <td>Rs. ${parseFloat(item.price).toFixed(2)}</td>
                    <td>${item.quantity}</td>
                    <td>Rs. ${(item.quantity * item.price).toFixed(2)}</td>
                    <td>
                        <button onclick='adjustQuantity(${item.id})' class="btn btn-sm btn-warning">Adjust Quantity</button>
                        <button onclick='deleteItem(${item.id})' class="btn btn-sm btn-danger">Remove</button>
                    </td>
                `;
                preorderList.appendChild(row);

                total += item.quantity * item.price;
            });
        }

        document.getElementById('total-summary').innerHTML = `<strong>Total: Rs. ${total.toFixed(2)}</strong>`;
    }

    function adjustQuantity(id) {
        const itemIndex = preOrderItems.findIndex(item => item.id === id);
        if (itemIndex >= 0) {
            const newQuantity = prompt('Enter new quantity:', preOrderItems[itemIndex].quantity);
            if (newQuantity >= 0) {
                if (parseInt(newQuantity, 10) === 0) {
                    deleteItem(id); // Remove item if quantity set to 0
                } else {
                    preOrderItems[itemIndex].quantity = parseInt(newQuantity, 10);
                    localStorage.setItem('preOrderItems', JSON.stringify(preOrderItems));
                    updatePreOrderList();
                }
            } else {
                alert('Please enter a valid quantity.');
            }
        }
    }

    function deleteItem(id) {
        const itemIndex = preOrderItems.findIndex(item => item.id === id);
        if (itemIndex >= 0) {
            const quantityToRemove = parseInt(prompt('Enter quantity to remove:', '1'), 10);

            if (quantityToRemove > 0 && quantityToRemove <= preOrderItems[itemIndex].quantity) {
                preOrderItems[itemIndex].quantity -= quantityToRemove;

                if (preOrderItems[itemIndex].quantity === 0) {
                    preOrderItems.splice(itemIndex, 1); // Remove item if quantity is 0
                }

                localStorage.setItem('preOrderItems', JSON.stringify(preOrderItems));
                updatePreOrderList();
            } else {
                alert('Invalid quantity. Please enter a number between 1 and ' + preOrderItems[itemIndex].quantity + '.');
            }
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        updatePreOrderList();
    });
</script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
