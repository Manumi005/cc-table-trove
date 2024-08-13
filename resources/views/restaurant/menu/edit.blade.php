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
            background-color: #f9f9f9;
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
            margin: auto;
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
        img {
            border-radius: 10px;
            margin-top: 10px;
            width: 150px;
            height: auto;
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
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ $menu->name }}" required>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="description">Description:</label>
                <textarea id="description" name="description">{{ $menu->description }}</textarea>
                @error('description')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" value="{{ $menu->price }}" required>
                @error('price')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="category">Category:</label>
                <select multiple id="category" name="category[]">
                    <option value="Starter" {{ in_array('Starter', $menu->category) ? 'selected' : '' }}>Starter</option>
                    <option value="Main Course" {{ in_array('Main Course', $menu->category) ? 'selected' : '' }}>Main Course</option>
                    <option value="Dessert" {{ in_array('Dessert', $menu->category) ? 'selected' : '' }}>Dessert</option>
                    <option value="Beverage" {{ in_array('Beverage', $menu->category) ? 'selected' : '' }}>Beverage</option>
                    <option value="Other" {{ in_array('Other', $menu->category) ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div>
                <label for="allergens">Allergens:</label>
                <input type="text" id="allergens" name="allergens[]" value="{{ implode(', ', $menu->allergens) }}" placeholder="Allergen (Optional)">
            </div>
            <div>
                <label for="image">Image:</label>
                <input type="file" id="image" name="image">
                @if($menu->image)
                    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" width="150">
                @endif
            </div>
            <div>
                <button type="submit">Update</button>
            </div>
        </form>
    </main>
</body>
</html>
