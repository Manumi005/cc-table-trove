<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add your styles here */
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
    </style>
</head>
<body>
    <main>
        <div class="restaurant-info">
            <h2 id="restaurant-name">Select a Restaurant</h2>
        </div>

        <ul id="menu-list">
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
            // This should be replaced with an actual fetch request to your backend
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
            const quantity = document.getElementById('quantity-input').value;
            if (quantity <= 0) {
                alert('Please enter a valid quantity.');
                return;
            }

            const existingItemIndex = preOrderItems.findIndex(item => item.id === selectedMenuItem.id);
            if (existingItemIndex >= 0) {
                preOrderItems[existingItemIndex].quantity = quantity;
            } else {
                preOrderItems.push({ ...selectedMenuItem, quantity });
            }

            localStorage.setItem('preOrderItems', JSON.stringify(preOrderItems));
            closeQuantityModal();
            updatePreOrderList();
        }

        function submitPreOrder() {
            fetch('/submit-preorder', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ preorder_items: preOrderItems }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Pre-order submitted successfully!');
                    localStorage.removeItem('preOrderItems');
                    updatePreOrderList();
                    window.location.href = "{{ route('preorder.summary') }}"; // Redirect to summary page
                } else {
                    alert('Error submitting pre-order.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error submitting pre-order.');
            });
        }

        function updateMenuList(menus) {
            const menuList = document.getElementById('menu-list');
            menuList.innerHTML = '';

            menus.forEach(menu => {
                const li = document.createElement('li');
                li.className = 'media mb-3';
                li.innerHTML = `
                    <img src="/images/${menu.image}" alt="${menu.name}">
                    <div class="media-body details">
                        <h2>${menu.name}</h2>
                        <p class="price">Rs. ${parseFloat(menu.price).toFixed(2)}</p>
                        <p class="category"><span>Category:</span> ${menu.category}</p>
                        <p class="allergens"><span>Allergens:</span> ${menu.allergens}</p>
                        <p class="dietary"><span>Dietary Preferences:</span> ${menu.dietary_preferences}</p>
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
                    const li = document.createElement('tr');
                    li.innerHTML = `
                        <td>${item.name}</td>
                        <td>Rs. ${parseFloat(item.price).toFixed(2)}</td>
                        <td>${item.quantity}</td>
                        <td>Rs. ${(item.quantity * item.price).toFixed(2)}</td>
                        <td>
                            <button onclick='editQuantity(${item.id})' class="btn btn-sm btn-warning">Edit</button>
                            <button onclick='deleteItem(${item.id})' class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    `;
                    preorderList.appendChild(li);

                    total += item.quantity * item.price;
                });
            }

            document.getElementById('total-summary').innerHTML = `<strong>Total: Rs. ${total.toFixed(2)}</strong>`;
        }

        function editQuantity(id) {
            const newQuantity = prompt('Enter new quantity:');
            if (newQuantity > 0) {
                const itemIndex = preOrderItems.findIndex(item => item.id === id);
                if (itemIndex >= 0) {
                    preOrderItems[itemIndex].quantity = newQuantity;
                    localStorage.setItem('preOrderItems', JSON.stringify(preOrderItems));
                    updatePreOrderList();
                }
            } else {
                alert('Please enter a valid quantity.');
            }
        }

        function deleteItem(id) {
            preOrderItems = preOrderItems.filter(item => item.id !== id);
            localStorage.setItem('preOrderItems', JSON.stringify(preOrderItems));
            updatePreOrderList();
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Example: Initialize with a selected restaurant for demonstration
            selectRestaurant(1, 'Restaurant Name'); // Replace with dynamic restaurant ID and name
            updatePreOrderList(); // Display pre-order items on page load
        });
    </script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</body>
</html>
