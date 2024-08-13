<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu Item</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        input[type="checkbox"] {
            margin-right: 10px;
        }

        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .checkbox-group label {
            margin-right: 20px;
            font-weight: normal;
        }

        .checkbox-group input {
            margin-right: 5px;
        }

        .checkbox-group div {
            margin-bottom: 10px;
        }

        button {
            padding: 10px 20px;
            background-color: #6C63FF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            align-self: flex-start;
        }

        button:hover {
            background-color: #5a54e0;
        }

        .error {
            color: #FF5C5C;
            margin: 5px 0;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Add New Menu Item</h1>
    </header>
    <main>
        <form id="menuForm" action="{{ route('restaurant.menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description">{{ old('description') }}</textarea>
                @error('description')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="price">Price (Rs.):</label>
                <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price') }}" required>
                @error('price')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select id="category" name="category[]" multiple required>
                    <option value="Starter" {{ in_array('Starter', old('category', [])) ? 'selected' : '' }}>Starter</option>
                    <option value="Main Course" {{ in_array('Main Course', old('category', [])) ? 'selected' : '' }}>Main Course</option>
                    <option value="Dessert" {{ in_array('Dessert', old('category', [])) ? 'selected' : '' }}>Dessert</option>
                    <option value="Beverage" {{ in_array('Beverage', old('category', [])) ? 'selected' : '' }}>Beverage</option>
                    <option value="Other" {{ in_array('Other', old('category', [])) ? 'selected' : '' }}>Other</option>
                </select>
                @error('category')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
                @error('image')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Allergens:</label>
                <div class="checkbox-group">
                    <div>
                        <input type="checkbox" id="allergen1" name="allergens[]" value="Peanuts" {{ in_array('Peanuts', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen1">Peanuts</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen2" name="allergens[]" value="Gluten" {{ in_array('Gluten', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen2">Gluten</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen3" name="allergens[]" value="Dairy" {{ in_array('Dairy', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen3">Dairy</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen4" name="allergens[]" value="Eggs" {{ in_array('Eggs', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen4">Eggs</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen5" name="allergens[]" value="Soy" {{ in_array('Soy', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen5">Soy</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen6" name="allergens[]" value="Tree Nuts" {{ in_array('Tree Nuts', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen6">Tree Nuts</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen7" name="allergens[]" value="Shellfish" {{ in_array('Shellfish', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen7">Shellfish</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen8" name="allergens[]" value="Fish" {{ in_array('Fish', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen8">Fish</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen9" name="allergens[]" value="Wheat" {{ in_array('Wheat', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen9">Wheat</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen10" name="allergens[]" value="Sesame" {{ in_array('Sesame', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen10">Sesame</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen11" name="allergens[]" value="Mustard" {{ in_array('Mustard', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen11">Mustard</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen12" name="allergens[]" value="Sulfites" {{ in_array('Sulfites', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen12">Sulfites</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen13" name="allergens[]" value="Lupin" {{ in_array('Lupin', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen13">Lupin</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen13" name="allergens[]" value="Celery" {{ in_array('Celery', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen13">Celery</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen13" name="allergens[]" value="Molluscs" {{ in_array('Molluscs', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen13">Molluscs</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen13" name="allergens[]" value=" Corn" {{ in_array(' Corn', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen13"> Corn</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen13" name="allergens[]" value="Sunflower" {{ in_array('Sunflower', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen13">Sunflower</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen13" name="allergens[]" value=" Poppy Seeds" {{ in_array(' Poppy Seeds', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen13"> Poppy Seeds</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen13" name="allergens[]" value=" Buckwheat" {{ in_array(' Buckwheat', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen13"> Buckwheat</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen13" name="allergens[]" value=" Latex" {{ in_array(' Latex', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen13"> Latex</label>
                    </div>
                    <div>
                        <input type="checkbox" id="allergen14" name="allergens[]" value="Other" {{ in_array('Other', old('allergens', [])) ? 'checked' : '' }}>
                        <label for="allergen14">Other (Please specify below)</label>
                        <input type="text" id="allergen-other" name="allergen_other" value="{{ old('allergen_other') }}">
                    </div>
                </div>
                @error('allergens')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Dietary Preferences:</label>
                <div class="checkbox-group">
                    <div>
                        <input type="checkbox" id="diet1" name="dietary[]" value="Vegetarian" {{ in_array('Vegetarian', old('dietary', [])) ? 'checked' : '' }}>
                        <label for="diet1">Vegetarian</label>
                    </div>
                    <div>
                        <input type="checkbox" id="diet2" name="dietary[]" value="Vegan" {{ in_array('Vegan', old('dietary', [])) ? 'checked' : '' }}>
                        <label for="diet2">Vegan</label>
                    </div>
                    <div>
                        <input type="checkbox" id="diet3" name="dietary[]" value="Non-Vegetarian" {{ in_array('Non-Vegetarian', old('dietary', [])) ? 'checked' : '' }}>
                        <label for="diet3">Non-Vegetarian</label>
                    </div>
                    <div>
                        <input type="checkbox" id="diet4" name="dietary[]" value="Pescatarian" {{ in_array('Pescatarian', old('dietary', [])) ? 'checked' : '' }}>
                        <label for="diet4">Pescatarian</label>
                    </div>
                    <div>
                        <input type="checkbox" id="diet5" name="dietary[]" value="Gluten-Free" {{ in_array('Gluten-Free', old('dietary', [])) ? 'checked' : '' }}>
                        <label for="diet5">Gluten-Free</label>
                    </div>
                    <div>
                        <input type="checkbox" id="diet6" name="dietary[]" value="Dairy-Free" {{ in_array('Dairy-Free', old('dietary', [])) ? 'checked' : '' }}>
                        <label for="diet6">Dairy-Free</label>
                    </div>
                    <div>
                        <input type="checkbox" id="diet7" name="dietary[]" value="Other" {{ in_array('Other', old('dietary', [])) ? 'checked' : '' }}>
                        <label for="diet7">Other (Please specify below)</label>
                        <input type="text" id="diet-other" name="diet_other" value="{{ old('diet_other') }}">
                    </div>
                </div>
                
            <div class="form-group">
                <button type="submit">Add Menu Item</button>
            </div>
        </form>
    </main>
</body>

</html>
