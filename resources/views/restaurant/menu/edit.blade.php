<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu Item</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
    body {
            font-family: Arial, sans-serif;
            background: url('{{ asset('images/wallpaper3.jpg') }}') no-repeat center center fixed;
            margin: 0;
            padding: 0;
            background-color: #98b2b8;
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
            width: 150px; /* Adjust size as needed */
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
            margin-left: 15px;
            margin-right: 20px;
            cursor: pointer;
        }
        .profile-icon img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }
        .top {
            background-color:#6397b5;
            color: white;
            padding: 20px;
            
          
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .top h1 {
            margin: 0;
           
            text-align: center;
            margin-top:-90px;
            margin-bottom: 30px;
            margin-left: 150px;

        }


        main {
            padding: 30px;
            max-width: 600px;
            padding: 30px;
            margin: 40px auto;
            background: #9bbfbe;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }

        .form-group input[type="text"],
        input[type="number"],
        textarea,
        select,
        input[type="file"] {
            display: block;
            margin-top: 5px;
            padding: 12px;
            border: 1px solid #333;
            border-radius: 6px;
            font-size: 1rem;
            width: 95%;
            background-color: #b1e3d5;
        }

        textarea {
            resize: vertical;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #333;
            border-radius: 4px;
            font-size: 1rem;
            font-family: inherit; /* Inherit the font from the parent element */
            width: 100%; /* Ensure it has the same width as other input elements */
            box-sizing: border-box; /* Include padding and border in the element's width */
        
        }

        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .checkbox-group div {
            display: flex;
            align-items: center;
        }

        .checkbox-group input[type="checkbox"] {
            margin-right: 10px;
        }

        button {
            padding: 12px 24px;
            background-color: #0288d1;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1.1rem;
            align-self: flex-start;
        }

        button:hover {
            background-color: #0277bd;
        }

        .error {
            color: #e57373;
            margin: 5px 0;
        }

        .checkbox-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .menu-icon {
            width: 100px; /* Adjust size as needed */
            height: auto;
            margin: 30px;
            margin-left: 400px
        
        }
    </style>
</head>

<body>

    <div class="top">
    <img src="{{ asset('images/add.png') }}" alt="Menu Icon" class="menu-icon">
       <h1> Add New Menu Item </h1>
    </div>
   
    <main>
        <form action="{{ route('restaurant.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

<!-- Name -->
<div class="form-group">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="{{ old('name', $menu->name) }}" required>
    @error('name')
        <div class="error">{{ $message }}</div>
    @enderror
</div>
            <!-- Description -->
            <div>
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required>{{ old('description', $menu->description) }}</textarea>
                @error('description')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Price -->
            <div>
                <label for="price">Price (Rs.):</label>
                <input type="number" id="price" name="price" step="0.01" value="{{ old('price', $menu->price) }}" required>
                @error('price')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Category -->
            <div>
                <label for="category">Category:</label>
                <select id="category" name="category[]" multiple required>
                    <option value="Starter" {{ in_array('Starter', old('category', $menu->category ?? [])) ? 'selected' : '' }}>Starter</option>
                    <option value="Main Course" {{ in_array('Main Course', old('category', $menu->category ?? [])) ? 'selected' : '' }}>Main Course</option>
                    <option value="Dessert" {{ in_array('Dessert', old('category', $menu->category ?? [])) ? 'selected' : '' }}>Dessert</option>
                    <option value="Beverage" {{ in_array('Beverage', old('category', $menu->category ?? [])) ? 'selected' : '' }}>Beverage</option>
                    <option value="Other" {{ in_array('Other', old('category', $menu->category ?? [])) ? 'selected' : '' }}>Other</option>
                </select>
                @error('category')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image -->
            <div>
                <label for="image">Image:</label>
                <input type="file" id="image" name="image">
                @error('image')
                    <div class="error">{{ $message }}</div>
                @enderror
                @if($menu->image)
                    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="image-preview">
                @endif
            </div>

            <!-- Allergens -->
            <div>
                <label>Allergens:</label>
                <div class="checkbox-group">
                    @php
                        $allergens = [
                            'Peanuts', 'Gluten', 'Dairy', 'Eggs', 'Soy', 'Tree Nuts', 'Shellfish', 
                            'Fish', 'Wheat', 'Sesame', 'Mustard', 'Sulfites', 'Lupin', 
                            'Celery', 'Molluscs', 'Corn', 'Sunflower', 'Poppy Seeds', 
                            'Buckwheat', 'Latex'
                        ];
                    @endphp

                    @foreach($allergens as $allergen)
                        <div>
                            <input type="checkbox" id="allergen_{{ $allergen }}" name="allergens[]" value="{{ $allergen }}" {{ in_array($allergen, old('allergens', $menu->allergens ?? [])) ? 'checked' : '' }}>
                            <label for="allergen_{{ $allergen }}">{{ $allergen }}</label>
                        </div>
                    @endforeach
                </div>
                @error('allergens')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Dietary Preferences -->
            <div>
                <label>Dietary Preferences:</label>
                <div class="checkbox-group">
                    @php
                        $dietary_preferences = [
                            'Vegetarian', 'Vegan', 'Non-Vegetarian', 
                            'Pescatarian', 'Gluten-Free', 'Dairy-Free'
                        ];
                    @endphp

                    @foreach($dietary_preferences as $dietary)
                        <div>
                            <input type="checkbox" id="dietary_{{ $dietary }}" name="dietary[]" value="{{ $dietary }}" {{ in_array($dietary, old('dietary', $menu->dietary ?? [])) ? 'checked' : '' }}>
                            <label for="dietary_{{ $dietary }}">{{ $dietary }}</label>
                        </div>
                    @endforeach
                </div>
                @error('dietary')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit">Update Menu Item</button>
        </form>
    </main>
</body>
</html>