<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>View Restaurant Profile</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($restaurant)
            <div class="form-group">
                <label for="name">Restaurant Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $restaurant->name }}" disabled>
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $restaurant->email }}" disabled>
            </div>

            <div class="form-group">
                <label for="contact_number">Contact Number</label>
                <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ $restaurant->contact_number }}" disabled>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $restaurant->address }}" disabled>
            </div>

            <div class="form-group">
                <label for="cuisine_type">Cuisine Type</label>
                <input type="text" class="form-control" id="cuisine_type" name="cuisine_type" value="{{ implode(', ', json_decode($restaurant->cuisine_type, true)) }}" disabled>
            </div>

            <div class="form-group">
                <label for="profile_image">Restaurant Image</label>
                @if($restaurant->profile_image)
                    <img src="{{ Storage::url($restaurant->profile_image) }}" alt="Restaurant Image" class="img-fluid">
                @else
                    <p>No image available.</p>
                @endif
            </div>

            <a href="{{ route('restaurant.profile.edit') }}" class="btn btn-secondary">Edit Profile</a>
        @else
            <p>No restaurant profile found. Create one now.</p>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
