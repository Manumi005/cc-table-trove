<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu Item</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
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
            max-width: 800px;
            margin: 40px auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="number"], textarea, select {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        input[type="file"] {
            padding: 10px 0;
        }
        button {
            padding: 10px 20px;
            background-color: #6C63FF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }
        button:hover {
            background-color: #5a54e0;
        }
        .error {
            color: #FF5C5C;
            margin: 5px 0;
        }
        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 15px;
        }
        .checkbox-group label {
            margin-right: 10px;
            font-weight: normal;
        }
        .checkbox-group input[type="checkbox"] {
            margin-right: 5px;
        }
        .image-preview {
            margin-top: 10px;
            max-width: 200px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <header>
        <h1>Edit Menu Item</h1>
    </header>
    <main>
        <form action="{{ route('restaurant.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
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
