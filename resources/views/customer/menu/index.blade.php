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
        -webkit-transition: width 0.3s ease;
    }

    nav ul li a:hover::after {
        width: 100%;
        left: 0;
        background-color: #fff;
    }

    .search-bar {
        display: flex;
        align-items: right;
        flex-grow: 1;
        justify-content: right;
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
        width: 120px;
        height: 120px;
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

    .quantity-modal-content {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        width: 80%;
        max-width: 400px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .quantity-modal-content input {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .quantity-modal-content button {
        background-color: #6C63FF;
        color: #fff;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
        margin-right: 10px;
    }
</style>

<body>

    <header>

        <nav>
            <img src="{{ asset('images/logo.png') }}" alt="Logo" onclick="location.href='/customer/dashboard'">
            <ul>
                <li><a href="{{ route('customer.restaurants') }}">Restaurants</a></li>
                <li><a href="{{ route('customer.reservations.index') }}">Reservations</a></li>
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
                            <input type="checkbox" name="allergy[]" value="{{ $allergy }}" {{ in_array($allergy, $userAllergens) ? 'checked' : '' }}>
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
                        <input type="range" id="price-range" min="0" max="1000" step="10" value="500" class="slider">
                        <p class="slider-label">Up to Rs. <span id="price-value">500</span></p>
                    </fieldset>

                    <!-- Apply Button -->
                    <button type="button" onclick="applyFilters()">Apply Filters</button>
                    <button type="button" onclick="closeFilterModal()">Close</button>
                </form>
            </div>
        </div>

        <ul id="menu-list">
            <div class="container">

                @foreach ($menus as $menu)
                <li>
                    <img src="{{ $menu->image ? asset('storage/' . $menu->image) : '' }}" alt="{{ $menu->name }}">
                    <div class="details">
                        <h2>{{ $menu->name }}</h2>
                        <p class="price">Rs. {{ number_format($menu->price, 2) }}</p>
                        <p class="category"><span>Category:</span> {{ $menu->category }}</p>
                        <p class="allergens"><span>Allergens:</span> {{ is_array($menu->allergens) ? implode(', ', $menu->allergens) : $menu->allergens }}</p>
                        <p class="dietary"><span>Dietary Preferences:</span> {{ is_array($menu->dietary_preferences) ? implode(', ', $menu->dietary_preferences) : $menu->dietary_preferences }}</p>
                        <i class="fas fa-shopping-cart order-icon" onclick='openQuantityModal(@json($menu))'></i>
                    </div>
                </li>
                @endforeach
            </div>
        </ul>

        <div class="quantity-modal" id="quantity-modal">
            <div class="quantity-modal-content">
                <h2>Enter Quantity</h2>
                <input type="number" id="quantity-input" min="1" value="1">
                <button onclick="addToPreOrder()">Add to Pre-Order</button>
                <button onclick="closeQuantityModal()">Cancel</button>
            </div>
        </div>

        <button onclick="goToPreOrderPage()">Go to Pre-Order Page</button>
    </main>

    <script>
        let selectedMenuItem = null;
        let preOrderItems = JSON.parse(localStorage.getItem('preOrderItems')) || [];

        function openQuantityModal(menuItem) {
            selectedMenuItem = menuItem;
            document.getElementById('quantity-modal').style.display = 'flex';
        }

        function closeQuantityModal() {
            document.getElementById('quantity-modal').style.display = 'none';
        }

        function addToPreOrder() {
            const quantity = document.getElementById('quantity-input').value;
            preOrderItems.push({ ...selectedMenuItem, quantity });
            localStorage.setItem('preOrderItems', JSON.stringify(preOrderItems));
            closeQuantityModal();
            console.log('Pre-Order Items:', preOrderItems);
        }

        function goToPreOrderPage() {
            window.location.href = '/pre-order';
        }

        function updateMenuList(menus) {
            const menuList = document.getElementById('menu-list');
            menuList.innerHTML = '';

            menus.forEach(menu => {
                const li = document.createElement('li');
                li.innerHTML = `
                    <img src="/images/${menu.image}" alt="${menu.name}">
                    <div class="details">
                        <h2>${menu.name}</h2>
                        <p class="price">Rs. ${parseFloat(menu.price).toFixed(2)}</p>
                        <p class="category"><span>Category:</span> ${menu.category}</p>
                        <p class="allergens"><span>Allergens:</span> ${menu.allergens}</p>
                        <p class="dietary"><span>Dietary Preferences:</span> ${menu.dietary_preferences}</p>
                        <i class="fas fa-shopping-cart order-icon" onclick='openQuantityModal(${JSON.stringify(menu)})'></i>
                    </div>
                `;
                menuList.appendChild(li);
            });
        }
    </script>

</body>

</html>