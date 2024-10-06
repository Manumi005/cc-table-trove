<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Payment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('{{ asset('images/background.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
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
        .search-bar button:hover {
            background-color: #ff45a1; /* Darker pink on hover */
        }
        .profile-icon {
            margin-left: 15px;
            margin-right: 20px;
            cursor: pointer;
        }
        .profile-icon img {
            width: 30px;
            height: 30px;
            margin-right: -10px;
            margin-left: 10px;
            border-radius: 50%;
        }
        .container {
            max-width: 600px;
            margin-top: 100px; /* Adjust margin to account for fixed header */
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #4ca1af;
        }
        .btn-primary {
            background: #4ca1af;
            border: #4ca1af;
        }
        .btn-primary:hover {
            background: #357f89;
        }
        .form-group label {
            font-weight: bold;
        }
        .text-center {
            margin-bottom: 20px;
        }
        .header, .footer {
            background-color: #4ca1af;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        .footer {
            margin-top: 50px;
        }
        .accepted-cards img {
            margin-right: 10px;
            width: 50px;
        }
        .security-note {
            font-size: 0.9em;
            color: #777;
            margin-top: 10px;
        }
        .ssl-badge {
            margin-top: 15px;
            text-align: center;
        }
        .text-danger {
            color: red;
            font-size: 0.875em; /* Slightly smaller font size for error messages */
        }
        .error-message {
            margin-top: 5px; /* Space between the input and the error message */
        }
    </style>
</head>
<body>
<header>
    <nav>
        <img src="{{ asset('images/logo.png') }}" alt="Logo" onclick="location.href='/customer/dashboard'">
        <ul>
            <li><a href="{{ route('customer.restaurants') }}">Restaurants</a></li>
            <li><a href="{{ route('customer.reservations.index') }}">Reservations</a></li>
            <li><a href="{{ route('customer.offers.index') }}">Offers & Promotions</a></li>
        </ul>
    </nav>
    <div class="search-bar">
        <form method="GET" action="{{ route('customer.restaurants') }}">
            <input type="text" name="query" placeholder="Search..." value="{{ request('query') }}">
        </form>
        <div class="profile-icon" onclick="location.href='/customer/profile'">
            <img src="{{ asset('images/profile.jpg') }}" alt="Profile">
        </div>
    </div>
</header>
<div class="container">
    <h2 class="text-center">Payment Details</h2>
    <div class="accepted-cards text-center">
        <img src="https://img.icons8.com/color/48/000000/visa.png" alt="Visa">
        <img src="https://img.icons8.com/color/48/000000/mastercard.png" alt="MasterCard">
        <img src="https://img.icons8.com/color/48/000000/amex.png" alt="American Express">
    </div>
    @if (session('message'))
        <div class="alert alert-info text-center">
            {{ session('message') }}
        </div>
    @endif
    <form id="paymentForm" action="{{ route('processPayment') }}" method="POST">
        @csrf
        <!-- Hidden field for reservationId -->
        <input type="hidden" name="reservationId" value="{{ $reservation->id }}">

        <div class="form-group">
            <label for="cardNumber">Card Number</label>
            <input type="text" class="form-control" id="cardNumber" name="cardNumber" required maxlength="16" pattern="\d{16}" title="Card number must be 16 digits.">
            <div id="cardNumberError" class="text-danger error-message" style="display: none;">Card number must be 16 digits.</div>
            @error('cardNumber')
            <div class="text-danger error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="cardName">Name on Card</label>
            <input type="text" class="form-control" id="cardName" name="cardName" required>
            <div id="cardNameError" class="text-danger error-message" style="display: none;">Name on card is required.</div>
            @error('cardName')
            <div class="text-danger error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="cardType">Card Type</label>
            <select class="form-control" id="cardType" name="cardType" required>
                <option value="Visa">Visa</option>
                <option value="MasterCard">MasterCard</option>
                <option value="American Express">American Express</option>
            </select>
            @error('cardType')
            <div class="text-danger error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="cvv">CVV</label>
            <input type="password" class="form-control" id="cvv" name="cvv" required maxlength="3" pattern="\d{3}" placeholder="123">
            @error('cvv')
            <div class="text-danger error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="expirationMonth">Expiration Date</label>
            <div class="row">
                <div class="col-md-6">
                    <select class="form-control" id="expirationMonth" name="expirationMonth" required>
                        <option value="">Month</option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    @error('expirationMonth')
                    <div class="text-danger error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <select class="form-control" id="expirationYear" name="expirationYear" required>
                        <option value="">Year</option>
                        @for ($year = date('Y'); $year <= date('Y') + 10; $year++)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                    @error('expirationYear')
                    <div class="text-danger error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div id="expirationDateError" class="text-danger error-message" style="display: none;">Expiration date must be in the future.</div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Pay Now</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.getElementById('paymentForm').addEventListener('submit', function(event) {
        const cardNumber = document.getElementById('cardNumber').value.replace(/\s+/g, '');
        const cardName = document.getElementById('cardName').value.trim();
        const cardNumberError = document.getElementById('cardNumberError');
        const currentDate = new Date();
        const expirationMonth = parseInt(document.getElementById('expirationMonth').value);
        const expirationYear = parseInt(document.getElementById('expirationYear').value);
        const expirationDateError = document.getElementById('expirationDateError');
        const cvv = document.getElementById('cvv').value;
        const cvvError = document.getElementById('cvvError');

        let valid = true;

        // Validate Card Number
        if (cardNumber.length !== 16) {
            cardNumberError.style.display = 'block';
            valid = false;
        } else {
            cardNumberError.style.display = 'none';
        }

        // Validate Name on Card
        if (cardName === '') {
            cardNameError.style.display = 'block';
            valid = false;
        } else {
            cardNameError.style.display = 'none';
        }

        // Validate CVV
        if (cvv.length !== 3) {
            cvvError.style.display = 'block';
            valid = false;
        } else {
            cvvError.style.display = 'none';
        }

        // Validate Expiration Date
        if (expirationYear < currentDate.getFullYear() || (expirationYear === currentDate.getFullYear() && expirationMonth < currentDate.getMonth() + 1)) {
            expirationDateError.style.display = 'block';
            valid = false;
        } else {
            expirationDateError.style.display = 'none';
        }

        if (!valid) {
            event.preventDefault();
        }
    });
</script>
</body>
</html>
