<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - {{ $restaurant->name }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #6C63FF;
            color: white;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-size: 2.5rem;
        }

        main {
            padding: 20px;
            max-width: 1200px;
            margin: auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .filter-button {
            background-color: #6C63FF;
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
            background: white;
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
            color: white;
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

        li {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        img {
            width: 120px;
            height: auto;
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
    </style>
</head>

<body>
    <header>
        <h1>Menu for {{ $restaurant->name }}</h1>
    </header>
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

                    <!-- Dietary -->
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
                        <input type="range" min="1000" max="10000" value="10000" class="slider" id="priceRange" name="priceRange">
                        <span class="slider-label">Up to ₹<span id="priceRangeValue">10000</span></span>
                    </fieldset>

                    <button type="button" onclick="applyFilter()">Apply Filters</button>
                    <button type="button" onclick="closeFilterModal()">Close</button>
                </form>
            </div>
        </div>

        <ul id="menu-list">
            @foreach($menus as $menu)
                <li>
                    <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}">
                    <div class="details">
                        <h2>{{ $menu->name }}</h2>
                        <p class="price">₹{{ $menu->price }}</p>
                        <p class="category"><span>Category:</span> {{ $menu->category }}</p>
                        <p class="allergens"><span>Allergens:</span> {{ $menu->allergens }}</p>
                        <p class="dietary"><span>Dietary:</span> {{ $menu->dietary }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </main>

    <script>
    // Update price range display as slider value changes
    document.getElementById('priceRange').addEventListener('input', function () {
        document.getElementById('priceRangeValue').textContent = this.value;
    });

    // Open the filter modal
    function openFilterModal() {
        document.getElementById('filter-modal').style.display = 'flex';
    }

    // Close the filter modal
    function closeFilterModal() {
        document.getElementById('filter-modal').style.display = 'none';
    }

    // Apply filters and fetch filtered menu items
    function applyFilter() {
        const form = document.getElementById('filter-form');
        const formData = new FormData(form);
        
        // Append restaurantId to formData
        formData.append('restaurantId', '{{ $restaurant->id }}');

        fetch("{{ route('customer.filter-menu') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            const menuList = document.getElementById('menu-list');
            menuList.innerHTML = ''; // Clear existing items

            if (data.length > 0) {
                data.forEach(menu => {
                    const listItem = document.createElement('li');
                    listItem.innerHTML = `
                        <img src="${menu.image_url}" alt="${menu.name}">
                        <div class="details">
                            <h2>${menu.name}</h2>
                            <p class="price">$${menu.price}</p>
                            <p class="category"><span>Category:</span> ${menu.category}</p>
                            <p class="allergens"><span>Allergens:</span> ${menu.allergens}</p>
                            <p class="dietary"><span>Dietary:</span> ${menu.dietary}</p>
                        </div>
                    `;
                    menuList.appendChild(listItem);
                });
            } else {
                menuList.innerHTML = '<li>No items match the selected filters.</li>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while applying filters. Please try again.');
        });

        closeFilterModal(); // Close the modal after applying filters
    }
</script>
</body>

</html>
