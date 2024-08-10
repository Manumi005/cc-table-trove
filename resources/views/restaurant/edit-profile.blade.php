<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Restaurant Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Restaurant Profile</h1>

        <form action="{{ route('restaurant.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Restaurant Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $restaurant->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $restaurant->email) }}" required>
            </div>

            <div class="form-group">
                <label for="contact_number">Contact Number</label>
                <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ old('contact_number', $restaurant->contact_number) }}">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $restaurant->address) }}" required>
            </div>

            <div class="form-group">
                <label for="cuisine_type">Cuisine Type</label>
                <select name="cuisine_type[]" id="cuisine_type" class="form-control" multiple required>
                    @php
                        $cuisines = ['Italian', 'Chinese', 'Sri Lankan']; // Add more as needed
                        $selectedCuisines = json_decode($restaurant->cuisine_type, true) ?? [];
                    @endphp
                    @foreach($cuisines as $cuisine)
                        <option value="{{ $cuisine }}" {{ in_array($cuisine, $selectedCuisines) ? 'selected' : '' }}>
                            {{ $cuisine }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="profile_image">Restaurant Image</label>
                <input type="file" class="form-control" id="profile_image" name="profile_image">
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
