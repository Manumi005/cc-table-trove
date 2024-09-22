<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - {{ $restaurant->name }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
    /* Your existing styles */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f9;
        background: url('{{ asset('images/wallpaper3.jpg') }}') no-repeat center center fixed;
        color: #333;
        margin: 0;
        padding: 0;
    }

    header {
        background-color: #333;
        color: #fff;
        padding: 10px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 60px;
    }

    nav {
        display: flex;
        align-items: center;
    }

    nav img {
        cursor: pointer;
        width: 150px;
        height: auto;
        margin-right: 20px;
    }

    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
    }

    nav ul li {
        margin: 0 15px;
    }

    nav ul li a {
        color: #fff;
        text-decoration: none;
        position: relative;
    }

    nav ul li a::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        display: block;
        margin-top: 5px;
        right: 0;
        background: #fff;
        transition: width 0.3s ease;
    }

    nav ul li a:hover::after {
        width: 100%;
        left: 0;
        background-color: #fff;
    }

    .search-bar {
        display: flex;
        align-items: flex-end;
        flex-grow: 1;
        justify-content: flex-end;
        margin: 0 20px;
    }

    .search-bar input {
        padding: 5px 10px;
        font-size: 16px;
        border: none;
        border-radius: 30px;
        width: 100%;
        max-width: 300px;
        background-color: #d9edff;
    }

    .profile-icon {
        margin-left: 40px;
        margin-right: -20px;
        cursor: pointer;
    }

    .profile-icon img {
        width: 30px;
        height: 30px;
        border-radius: 50%;
    }

    .top {
        background-color: #8a6378;
        color: white;
        padding: 20px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .top h1 {
        margin: 0;
        font-size: 2.5rem;
    }

    main {
        padding: 20px;
        max-width: 1200px;
        margin: auto;
        background-color: none;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .filter-button {
        background-color: #cd77ad;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 15px;
        cursor: pointer;
        font-size: 1rem;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .filter-button i {
        margin-right: 8px;
    }

    .filter-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        align-items: center;
        justify-content: center;
    }

    .filter-modal-content {
        background: #cce3f3;
        padding: 20px;
        border-radius: 8px;
        width: 80%;
        max-width: 500px;
        max-height: 80vh;
        overflow-y: auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .filter-modal-content h2 {
        margin-top: 0;
    }

    .filter-modal-content label {
        display: flex;
        align-items: center;
        margin: 10px 0;
    }

    .filter-modal-content input[type="checkbox"] {
        margin-right: 10px;
    }

    .filter-modal-content .slider {
        width: 100%;
        margin: 10px 0;
    }

    .filter-modal-content .slider-label {
        font-size: 0.9rem;
        color: #666;
    }

    .filter-modal-content button {
        background-color: #6C63FF;
        color: #333;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
        margin-right: 10px;
    }

    ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .container li {
        margin-bottom: 20px;
        padding: 20px;
        background-color: #d6b8dc;
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        display: flex;
        color: #333333;
        align-items: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-left: 8px solid #6397b5;
    }

    .container li:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }

    img {
        width: 250px;
        height: 250px;
        border-radius: 8px;
        margin-right: 20px;
    }

    .details {
        flex: 1;
    }

    h2 {
        margin: 0;
        font-size: 1.5rem;
        color: #333;
    }

    p {
        margin: 5px 0;
    }

    .price {
        font-size: 1.2rem;
        color: #6C63FF;
        font-weight: bold;
    }

    .category,
    .allergens,
    .dietary {
        margin-top: 10px;
        font-size: 0.9rem;
        color: #666;
    }

    .category span,
    .allergens span,
    .dietary span {
        font-weight: bold;
    }

    .order-icon {
        cursor: pointer;
        margin-left: 10px;
        color: #6C63FF;
    }

    .quantity-modal {
        display: none; /* Ensure it's hidden by default */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
        align-items: center; /* Center items vertically */
        justify-content: center; /* Center items horizontally */
        z-index: 1000; /* Ensure it's above other content */
    }

    .quantity-modal-content {
        background: #cce3f3; /* Match the filter modal background */
        padding: 20px;
        border-radius: 8px;
        width: 80%;
        max-width: 400px; /* Adjust the max width if needed */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center; /* Center text inside the modal */
    }

    .quantity-modal-content h2 {
        margin-bottom: 15px; /* Add space below the heading */
    }

    .quantity-modal-content input[type="number"] {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: calc(100% - 20px); /* Full width minus padding */
        margin-bottom: 15px; /* Space below the input */
    }

    .quantity-modal-content button {
        background-color: #6C63FF; /* Match the button color theme */
        color: #fff; /* White text */
        border: none; /* Remove default border */
        padding: 10px 15px; /* Spacing */
        border-radius: 5px; /* Rounded corners */
        cursor: pointer; /* Pointer cursor */
        font-size: 1rem; /* Font size */
        transition: background-color 0.3s ease, transform 0.3s ease; /* Smooth transition */
        margin: 5px; /* Space between buttons */
    }

    .quantity-modal-content button:hover {
        background-color: #5a54d7; /* Darker shade on hover */
        transform: scale(1.05); /* Slightly increase size on hover */
    }

    /* Add these styles for the 'Go to Pre Order' button */
    button.preorder {
        background-color: #6C63FF; /* Match the color theme */
        color: #fff; /* White text color */
        border: none; /* Remove default border */
        border-radius: 5px; /* Rounded corners */
        padding: 10px 20px; /* Spacing around the text */
        cursor: pointer; /* Pointer cursor on hover */
        font-size: 1rem; /* Font size */
        text-align: center; /* Center the text */
        display: block; /* Block level element */
        margin: 20px auto; /* Center the button horizontally with margin */
        transition: background-color 0.3s ease, transform 0.3s ease; /* Smooth transition */
    }

    button.preorder:hover {
        background-color: #5a54d7; /* Slightly darker shade on hover */
        transform: scale(1.05); /* Slightly increase size on hover */
    }

    button.preorder:focus {
        outline: none; /* Remove default outline */
    }

    .quantity-btn {
        background-color: #6C63FF; /* Match the color theme */
        color: #fff; /* White text color */
        border: none; /* Remove default border */
        border-radius: 5px; /* Rounded corners */
        padding: 10px 15px; /* Spacing around the text */
        cursor: pointer; /* Pointer cursor on hover */
        font-size: 1rem; /* Font size */
        transition: background-color 0.3s ease, transform 0.3s ease; /* Smooth transition */
    }

    .quantity-btn:hover {
        background-color: #5a54d7; /* Slightly darker shade on hover */
        transform: scale(1.05); /* Slightly increase size on hover */
    }
</style>
<body>
<header>
    <nav>
        <img src="{{ asset('images/logo.png') }}" alt="Logo" onclick="location.href='/customer/dashboard'">
        <ul>
            <li><a href="{{ route('customer.restaurants') }}">Restaurants</a></li>
            <li><a href="{{ route('customer.reservations.index') }}">Reservations</a></li>
            <li><a href="{{ route('customer.offers.index') }}">Offers & Promotions</a></li>
        </ul>
    </nav>
    <div class="search-bar">
        <form method="GET" action="{{ route('customer.restaurants') }}">
            <input type="text" name="query" placeholder="Search..." value="{{ request('query') }}">
        </form>
        <div class="profile-icon" onclick="location.href='/customer/profile'">
            <img src="{{ asset('images/profile.jpg') }}" alt="Profile">
        </div>
    </div>
</header>

<div class="top">
    <h1>Menu for {{ $restaurant->name }}</h1>
</div>

<main>
    <button class="filter-button" onclick="openFilterModal()">
        <i class="fas fa-filter"></i> Filter
    </button>

    <div class="filter-modal" id="filter-modal">
        <div class="filter-modal-content">
            <h2>Filter Options</h2>
            <form id="filter-form">
                <!-- Allergies -->
                <fieldset>
                    <legend>Allergies</legend>
                    @foreach(['Peanuts', 'Gluten', 'Dairy', 'Eggs', 'Soy', 'Tree Nuts', 'Shellfish', 'Fish', 'Wheat', 'Sesame', 'Mustard', 'Sulfites', 'Lupin', 'Celery', 'Molluscs', 'Corn', 'Sunflower', 'Poppy Seeds'] as $allergy)
                        <label>
                            <input type="checkbox" name="allergies[]" value="{{ $allergy }}">
                            {{ $allergy }}
                        </label>
                    @endforeach
                </fieldset>

                <!-- Dietary Preferences -->
                <fieldset>
                    <legend>Dietary Preferences</legend>
                    @foreach(['Vegetarian', 'Vegan', 'Non-Vegetarian', 'Pescatarian', 'Halal', 'Kosher'] as $dietary)
                        <label>
                            <input type="checkbox" name="dietary[]" value="{{ $dietary }}">
                            {{ $dietary }}
                        </label>
                    @endforeach
                </fieldset>

                <!-- Price Range -->
                <fieldset>
                    <legend>Price Range</legend>
                    <input type="range" id="price-range" name="priceRange" min="500" max="15000" step="10" value="15000" class="slider">
                    <p class="slider-label">Up to Rs. <span id="price-value">15000</span></p>
                </fieldset>

                <!-- Apply Filters Button -->
                <button type="button" onclick="applyFilters()">Apply Filters</button>
                <button type="button" id="close-filter-modal">Close</button>
            </form>
        </div>
    </div>

    <ul id="menu-list">
        <div class="container">
            @foreach ($menus as $menu)
                <li data-allergies='{{ json_encode(json_decode($menu->allergens)) }}'
                    data-dietary='{{ json_encode(json_decode($menu->dietary)) }}'
                    data-price="{{ $menu->price }}">

                    <img src="{{ $menu->image ? asset('storage/' . $menu->image) : '' }}" alt="{{ $menu->name }}">
                    <div class="details">
                        <h2>{{ $menu->name }}</h2>
                        <p class="price">Rs. {{ number_format($menu->price, 2) }}</p>
                        <p>Category: {{ implode(', ', json_decode($menu->category) ?? ['N/A']) }}</p>
                        <p>Allergens: {{ implode(', ', json_decode($menu->allergens) ?? ['N/A']) }}</p>
                        <p>Dietary: {{ implode(', ', json_decode($menu->dietary) ?? ['N/A']) }}</p>
                        <p>Description: {{ $menu->description }}</p>
                        <button class="quantity-btn" onclick="openQuantityModal({{ $menu->id }})">Add to Cart</button>
                    </div>
                </li>
            @endforeach
        </div>
    </ul>

    <!-- Ensure reservation ID is passed to the "Go to Pre-Order" button -->
    <button class="preorder" onclick="window.location.href='{{ route('preorders.index', ['reservation' => $reservation->id]) }}'">Go to Pre-Order</button>


</main>

<!-- Quantity Modal -->
<div id="quantity-modal" class="quantity-modal" style="display:none;">
    <div class="quantity-modal-content">
        <h2>Select Quantity</h2>
        <input type="number" id="quantity-input" min="1" placeholder="Enter Value">
        <div>
            <button onclick="addToCart()">Add to Cart</button>
            <button onclick="closeQuantityModal()">Cancel</button>
        </div>
    </div>
</div>

<script>
    let currentMenuId = null;
    let reservationId = "{{ $reservation->id ?? '' }}"; // Ensure $reservation is passed to the view

    function openQuantityModal(menuId) {
        document.getElementById('quantity-modal').style.display = 'flex';
        currentMenuId = menuId;
    }

    function closeQuantityModal() {
        document.getElementById('quantity-modal').style.display = 'none';
    }

    function addToCart() {
        let quantity = document.getElementById('quantity-input').value;

        if (!quantity || quantity <= 0) {
            alert('Please enter a valid quantity.');
            return;
        }

        let preOrderData = {
            reservation_id: reservationId,
            menu_id: currentMenuId,
            quantity: quantity,
            _token: "{{ csrf_token() }}"
        };

        fetch("{{ route('preorders.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": preOrderData._token
            },
            body: JSON.stringify(preOrderData)
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    closeQuantityModal();
                } else {
                    alert(data.message || 'Failed to add item to pre-order');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
    function openFilterModal() {
        document.getElementById('filter-modal').style.display = 'flex';
    }

    // Function to close the filter modal
    function closeFilterModal() {
        document.getElementById('filter-modal').style.display = 'none';
    }

    // Add event listener to close the filter modal when clicking outside the modal content
    window.onclick = function (event) {
        const modal = document.getElementById('filter-modal');
        if (event.target == modal) {
            closeFilterModal();
        }
    };

    document.addEventListener('DOMContentLoaded', function () {
        // Add event listeners to the filter checkboxes and price range slider
        document.querySelectorAll('input[name="allergies[]"], input[name="dietary[]"], #price-range').forEach((element) => {
            element.addEventListener('change', applyFilters);
        });
    });

    // Update the displayed price value when the slider is moved
    const priceRange = document.getElementById('price-range');
    const priceValue = document.getElementById('price-value');
    priceRange.oninput = function () {
        priceValue.innerHTML = this.value;
    };


    function applyFilters() {
        let allergies = [];
        let dietary = [];
        let maxPrice = document.getElementById("price-range").value;

        // Collect selected allergens
        document.querySelectorAll('input[name="allergies[]"]:checked').forEach((checkbox) => {
            allergies.push(checkbox.value);
        });

        // Collect selected dietary preferences
        document.querySelectorAll('input[name="dietary[]"]:checked').forEach((checkbox) => {
            dietary.push(checkbox.value);
        });

        // Filter the menu items
        let menuItems = document.querySelectorAll('#menu-list li');

        menuItems.forEach((item) => {
            let itemAllergies = [];
            let itemDietary = [];
            try {
                itemAllergies = JSON.parse(item.getAttribute('data-allergies')) || [];
                itemDietary = JSON.parse(item.getAttribute('data-dietary')) || [];
            } catch (error) {
                console.error("Failed to parse allergens or dietary data:", error);
            }

            let itemPrice = parseFloat(item.getAttribute('data-price'));

            // Filter based on allergens
            let matchesAllergies = allergies.every(allergy => !itemAllergies.includes(allergy));

            // Filter based on dietary preferences
            let matchesDietary = dietary.every(diet => itemDietary.includes(diet));

            // Filter based on price
            let matchesPrice = itemPrice <= maxPrice;

            // Show/Hide item based on filter conditions
            if (matchesAllergies && matchesDietary && matchesPrice) {
                item.style.display = 'flex'; // Show item if it matches all conditions
            } else {
                item.style.display = 'none'; // Hide item if it doesn't match
            }
        });

    }

    // Update price label as slider moves
    document.getElementById("price-range").addEventListener("input", function() {
        document.getElementById("price-value").innerText = this.value;
    });

    // Close modal on button click
    document.getElementById("close-filter-modal").addEventListener("click", function() {
        document.getElementById("filter-modal").style.display = "none";
    });

    function openFilterModal() {
        document.getElementById("filter-modal").style.display = "flex";
    }

    function closeFilterModal() {
        document.getElementById("filter-modal").style.display = "none";
    }


</script>


</body>


</html>
