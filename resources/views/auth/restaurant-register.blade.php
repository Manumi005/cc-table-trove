<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('{{ asset('images/wallpaper1.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
           
            margin: 0;
            overflow-y: auto; /* Enable vertical scrolling */
        }
        .register-container {
            background-color: #2a1d25;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            color: white;
            margin-top: 20px;
            margin-bottom: 20px;
            opacity: 0.9;
        }
        .register-container h2 {
            margin-bottom: 25px;
            font-size: 24px;
            text-align: center;
            color: #e4cfdc;
        }
        .register-container label {
            display: block;
            margin-bottom: 10px;
            font-size: 14px;
            color: #fff;
        }
        .register-container input[type="text"],
        .register-container input[type="email"],
        .register-container input[type="password"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 15px;
            font-size: 14px;
            background-color: #ead8f4;
        }
        .register-container input[type="text"].other-cuisine {
            width: calc(100% - 32px);
            padding: 12px;
            margin-top: 5px;
        }
        .error-message {
            color: #ff6f61;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 10px;
        }
        .logo-container {
            margin: 20px 0;
            text-align: center;
        }
        .logo-container img {
            width: 180px;
            height: auto;
        }
        .register-container button {
            width: 100%;
            padding: 15px;
            margin: 20px 0;
            background: linear-gradient(135deg, #9e1e8b, #892abc);
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
        }
        .register-container button:hover {
            background: linear-gradient(135deg, #892abc, #9e1e8b);
            transform: scale(1.02);
        }
        .register-container .no-account {
            margin-top: 20px;
            text-align: center;
        }
        .register-container .no-account a {
            color: #007bff;
            text-decoration: none;
        }
        .register-container .no-account a:hover {
            text-decoration: underline;
        }
        .cuisine-options {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); /* Adjust columns based on available space */
    gap: 10px; /* Space between grid items */
    margin-bottom: 20px;
}

.other-cuisine-container {
    display: flex;
    align-items: center;
    margin-top: 10px;
    gap: 10px; /* Adds space between the checkbox and the input field */
}

.other-cuisine-container label {
    margin: 0; /* Remove any default margin on the label */
    white-space: nowrap; /* Prevents the text from wrapping to the next line */
}

.other-cuisine-container input[type="text"] {
    flex-grow: 1; /* Allows the text input to take up the remaining space */
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
    color: #555;
}


        @media (max-width: 600px) {
            .register-container {
                padding: 15px;
            }
            .register-container h2 {
                font-size: 24px;
            }
            .register-container input,
            .register-container button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="logo-container">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
        </div>
        <h2>Restaurant Register</h2>
        <form id="register-form" method="POST" action="{{ route('restaurant.register') }}">
            @csrf
            <label for="name">Restaurant Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <label for="contact_number">Contact Number</label>
            <input type="text" id="contact_number" name="contact_number" value="{{ old('contact_number') }}" required>
            @error('contact_number')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="{{ old('address') }}" required>
            @error('address')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
            @error('password_confirmation')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <label for="cuisine_type">Cuisine Type</label>
            <div class="cuisine-options">
                <div>
                    <input type="checkbox" id="srilankan" name="cuisine_type[]" value="Sri Lankan" 
                        {{ (is_array(old('cuisine_type')) && in_array('Sri Lankan', old('cuisine_type'))) ? 'checked' : '' }}>
                    <label for="srilankan">Sri Lankan</label>
                </div>
                <div>
                    <input type="checkbox" id="italian" name="cuisine_type[]" value="Italian" 
                        {{ (is_array(old('cuisine_type')) && in_array('Italian', old('cuisine_type'))) ? 'checked' : '' }}>
                    <label for="italian">Italian</label>
                </div>
                <div>
                    <input type="checkbox" id="chinese" name="cuisine_type[]" value="Chinese" 
                        {{ (is_array(old('cuisine_type')) && in_array('Chinese', old('cuisine_type'))) ? 'checked' : '' }}>
                    <label for="chinese">Chinese</label>
                </div>
                <div>
                    <input type="checkbox" id="mexican" name="cuisine_type[]" value="Mexican" 
                        {{ (is_array(old('cuisine_type')) && in_array('Mexican', old('cuisine_type'))) ? 'checked' : '' }}>
                    <label for="mexican">Mexican</label>
                </div>
                <div>
                    <input type="checkbox" id="indian" name="cuisine_type[]" value="Indian" 
                        {{ (is_array(old('cuisine_type')) && in_array('Indian', old('cuisine_type'))) ? 'checked' : '' }}>
                    <label for="indian">Indian</label>
                </div>
                <div>
                    <input type="checkbox" id="thai" name="cuisine_type[]" value="Thai" 
                        {{ (is_array(old('cuisine_type')) && in_array('Thai', old('cuisine_type'))) ? 'checked' : '' }}>
                    <label for="thai">Thai</label>
                </div>
                <div>
                    <input type="checkbox" id="korean" name="cuisine_type[]" value="Korean" 
                        {{ (is_array(old('cuisine_type')) && in_array('Korean', old('cuisine_type'))) ? 'checked' : '' }}>
                    <label for="korean">Korean</label>
                </div>
                <div>
                    <input type="checkbox" id="japanese" name="cuisine_type[]" value="Japanese" 
                        {{ (is_array(old('cuisine_type')) && in_array('Japanese', old('cuisine_type'))) ? 'checked' : '' }}>
                    <label for="japanese">Japanese</label>
                </div>
                <div class="other-cuisine-container">
                    <input type="checkbox" id="other_cuisine" name="cuisine_type[]" value="Other">
                    <label for="other_cuisine">Other</label>
                    <input type="text" id="other_cuisine_type" name="other_cuisine_type" 
                        value="{{ old('other_cuisine_type') }}" placeholder="Specify Other Cuisine">
                </div>
            </div>
            @error('cuisine_type')
                <div class="error-message">{{ $message }}</div>
            @enderror
            @error('other_cuisine_type')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <button type="submit">Register</button>
            <div class="no-account">
                Already have an account? <a href="{{ route('restaurant.login') }}">Login here</a>
            </div>
        </form>
    </div>
</body>
</html>