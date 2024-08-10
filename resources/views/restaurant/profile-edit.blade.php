<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Restaurant Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            display: block;
            margin-bottom: .5rem;
            font-weight: bold;
            color: #495057;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: .5rem;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            box-sizing: border-box;
        }
        .form-group textarea {
            resize: vertical;
        }
        .form-group input[type="file"] {
            border: none;
            padding: .5rem 0;
        }
        .btn {
            padding: .75rem 1.5rem;
            border: none;
            border-radius: .25rem;
            color: #ffffff;
            background-color: #007bff;
            cursor: pointer;
            transition: background-color .3s ease;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .checkbox-group label {
            display: inline-flex;
            align-items: center;
            margin-right: 1rem;
        }
        .checkbox-group input {
            margin-right: .5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-2xl font-semibold mb-6">Edit Restaurant Profile</h1>
        
        <form action="{{ route('restaurant.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Profile Image Upload -->
            <div class="form-group">
                <label for="image">Profile Image</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>

            <!-- Restaurant Name -->
            <div class="form-group">
                <label for="name">Restaurant Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $restaurant->name) }}" class="form-control @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $restaurant->email) }}" class="form-control @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contact Number -->
            <div class="form-group">
                <label for="contact_number">Contact Number</label>
                <input type="text" id="contact_number" name="contact_number" value="{{ old('contact_number', $restaurant->contact_number) }}" class="form-control @error('contact_number') border-red-500 @enderror">
                @error('contact_number')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address -->
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="{{ old('address', $restaurant->address) }}" class="form-control @error('address') border-red-500 @enderror">
                @error('address')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Cuisine Type -->
            <div class="form-group">
                <label>Cuisine Type</label>
                <div class="checkbox-group">
                    @php
                        $cuisineTypes = json_decode($restaurant->cuisine_type, true) ?? [];
                        $oldCuisineTypes = old('cuisine_type', $cuisineTypes) ?? [];
                    @endphp
                    <label>
                        <input type="checkbox" name="cuisine_type[]" value="Italian" {{ in_array('Italian', $oldCuisineTypes) ? 'checked' : '' }}> Italian
                    </label>
                    <label>
                        <input type="checkbox" name="cuisine_type[]" value="Chinese" {{ in_array('Chinese', $oldCuisineTypes) ? 'checked' : '' }}> Chinese
                    </label>
                    <label>
                        <input type="checkbox" name="cuisine_type[]" value="Mexican" {{ in_array('Mexican', $oldCuisineTypes) ? 'checked' : '' }}> Mexican
                    </label>
                    <label>
                        <input type="checkbox" name="cuisine_type[]" value="Indian" {{ in_array('Indian', $oldCuisineTypes) ? 'checked' : '' }}> Indian
                    </label>
                    <label>
                        <input type="checkbox" name="cuisine_type[]" value="Japanese" {{ in_array('Japanese', $oldCuisineTypes) ? 'checked' : '' }}> Japanese
                    </label>
                    <label>
                        <input type="checkbox" name="cuisine_type[]" value="Thai" {{ in_array('Thai', $oldCuisineTypes) ? 'checked' : '' }}> Thai
                    </label>
                    <!-- Add more options as needed -->
                </div>
                @error('cuisine_type')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Opening Hours -->
            <div class="form-group">
                <label for="opening_hours_start">Opening Hours Start</label>
                <input type="time" id="opening_hours_start" name="opening_hours_start" value="{{ old('opening_hours_start', $restaurant->opening_hours_start) }}" class="form-control @error('opening_hours_start') border-red-500 @enderror">
                @error('opening_hours_start')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="opening_hours_end">Opening Hours End</label>
                <input type="time" id="opening_hours_end" name="opening_hours_end" value="{{ old('opening_hours_end', $restaurant->opening_hours_end) }}" class="form-control @error('opening_hours_end') border-red-500 @enderror">
                @error('opening_hours_end')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Details -->
            <div class="form-group">
                <label for="details">Details</label>
                <textarea id="details" name="details" rows="4" class="form-control @error('details') border-red-500 @enderror">{{ old('details', $restaurant->details) }}</textarea>
                @error('details')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn">Update Profile</button>
            <a href="{{ route('restaurant.profile.show') }}" class="btn btn-danger">Cancel</a>

        </form>
    </div>
</body>
</html>
