<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
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
            border-radius: 5px;
        }
        .order-icon {
            cursor: pointer;
            color: #007bff;
        }
        .restaurant-info {
            margin-bottom: 20px;
        }
        .fixed-bottom-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000; /* Ensure the button is above other content */
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
        .preorder-summary {
            margin-top: 20px;
        }
        .preorder-summary table th,
        .preorder-summary table td {
            text-align: center;
        }
    </style>
</head>
<body>
    <main class="container">
        <div class="restaurant-info">
            <h2 id="restaurant-name">Select a Restaurant</h2>
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
    </main>

    <button id="submitPreOrderBtn" class="btn btn-success fixed-bottom-btn" onclick="submitPreOrder()">Submit Pre-Order</button>

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
