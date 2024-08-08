<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('images/wallpaper1.jpg') no-repeat center center fixed;
            margin: 0;
            padding: 0;
            background-color: #cd9cc0;
        }

        .outer-container {
            position: absolute; 
            top: 50%; 
            left: 50%; 
            transform: translate(-50%, -50%); 
            width: 80%; 
            max-width: 600px; 
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav {
            display: flex;
            align-items: center;
        }

        nav img {
            cursor: pointer;
            width: 150px;
            height: 60px;
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
            align-items: center;
        }

        .search-bar input {
            padding: 5px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
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

        .container {
            width: 100%;
            background-color: #e6cbdc;
            padding: 20px;
            margin-top: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .profile-info-left {
            display: flex;
            align-items: center;
        }

        .profile-info-right {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            width: 50%; 
        }

        .profile-info label {
            font-weight: bold;
            margin-right: 20px;
            min-width: 150px;
            white-space: nowrap;
        }

        .profile-info p, .profile-info input, .profile-info select {
            margin: 0;
            padding: 5px;
            background-color: #f1f1f1;
            border-radius: 5px;
            width: 50%;
            height: 30px;
            box-sizing: border-box;
        }

        .profile-info img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            display: block;
            margin-right: 20px;
        }

        .edit-icon {
            position: absolute;
            top: 60px;
            left: 10px; 
            width: 30px;
            height: 30px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .edit-icon:hover {
            background-color: #7c347d;
        }

        .profile-info button {
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            margin-right: 10px; 
            transition: background-color 0.3s ease;
        }

        .profile-info-logout button {
            background-color: #e57373;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .profile-info button:hover {
            background-color: #7c347d;
        }

        .profile-info-logout button:hover {
            background-color: #d32f2f;
        }

        .scrollable-container {
            max-height: 200px;
            overflow-y: auto;
            margin-bottom: 20px;
        }

        .modal-content {
            background-color: #ccb9c5;
            margin: 50px auto;
            padding: 20px;
            width: 50%;
            border-radius: 10px;
            position: relative;
            max-height: 80vh;
            overflow-y: auto;
        }

        .modal-content span {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 20px;
        }
    </style>
</head>
<body>
<header>
    <nav>
        <img src="images/logo.png" alt="Logo" onclick="location.href='/dashboard'">
        <ul>
            <li><a href="#">Restaurants</a></li>
            <li><a href="#">Reservations</a></li>
        </ul>
    </nav>
    <div class="search-bar">
        <input type="text" placeholder="Search...">
        <div class="profile-icon" onclick="location.href='/profile'">
       
            <img src="images/profile.jpg" alt="Profile">
        </div>
    </div>
</header>
<div class="black-transparent-card">
    <div class="outer-container">
        <div class="container">
            <button class="edit-icon" onclick="document.getElementById('editModal').style.display='block'">✎</button>
            <div class="profile-info">
                <div class="profile-info-left">
                    <img src="images/profile.jpg" alt="Profile Image">
                </div>
                <div class="profile-info-right">
                    <button onclick="document.getElementById('editModal').style.display='block'">Payments</button>
                    <div class="profile-info-logout">
                        <button onclick="logout()">Logout</button>
                    </div> 
                </div>
            </div>
            <div class="profile-info">
                <label for="name">Name:</label>
                <p id="name">{{ $user->name }}</p>
            </div>
            <div class="profile-info">
                <label for="email">Email:</label>
                <p id="email">{{ $user->email }}</p>
            </div>
            <div class="profile-info">
                <label for="contactNumber">Contact Number:</label>
                <p id="contactNumber">{{ $user->contact_number }}</p>
            </div>
            <div class="profile-info">
                <label for="allergies">Allergies:</label>
                <p id="allergies">{{ implode(', ', $user->allergies ?? []) }}</p>
            </div>
            <div class="profile-info">
                <label for="preferences">Dietary Preferences:</label>
                <p id="preferences">{{ implode(', ', $user->preferences ?? []) }}</p>
            </div>
        </div>
    </div>
</div>

<div id="editModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5);">
    <div class="modal-content">
        <span onclick="document.getElementById('editModal').style.display='none'">&times;</span>
        <h2>Edit Profile</h2>
        <form action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="profile-info">
                <label for="editName">Name:</label>
                <input type="text" id="editName" name="name" value="{{ old('name', $user->name) }}">
            </div>
            <div class="profile-info">
                <label for="editEmail">Email:</label>
                <input type="email" id="editEmail" name="email" value="{{ old('email', $user->email) }}">
            </div>
            <div class="profile-info">
                <label for="editContactNumber">Contact Number:</label>
                <input type="text" id="editContactNumber" name="contact_number" value="{{ old('contact_number', $user->contact_number) }}">
            </div>
            <div class="profile-info">
                <label for="editAllergies">Allergies:</label>
                <select id="editAllergies" name="allergies[]" multiple>
                    @foreach ($allergyOptions as $allergy)
                        <option value="{{ $allergy }}" {{ in_array($allergy, old('allergies', $user->allergies ?? [])) ? 'selected' : '' }}>
                            {{ $allergy }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="profile-info">
                <label for="editPreferences">Dietary Preferences:</label>
                <select id="editPreferences" name="preferences[]" multiple>
                    @foreach ($preferenceOptions as $preference)
                        <option value="{{ $preference }}" {{ in_array($preference, old('preferences', $user->preferences ?? [])) ? 'selected' : '' }}>
                            {{ $preference }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="profile-info">
                <label for="profileImage">Profile Image:</label>
                <input type="file" id="profileImage" name="profile_image">
            </div>
            <div class="profile-info">
                <button type="submit">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    function logout() {
        // Add your logout logic here
    }
</script>
</body>
</html>
