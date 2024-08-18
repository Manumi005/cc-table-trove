<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Payment</h2>
        <form action="{{ route('processPayment') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="cardNumber">Card Number</label>
                <input type="text" class="form-control" id="cardNumber" name="cardNumber" required>
            </div>
            <div class="form-group">
                <label for="cardName">Name on Card</label>
                <input type="text" class="form-control" id="cardName" name="cardName" required>
            </div>
            <div class="form-group">
                <label for="cardType">Card Type</label>
                <select class="form-control" id="cardType" name="cardType" required>
                    <option value="Visa">Visa</option>
                    <option value="MasterCard">MasterCard</option>
                    <option value="American Express">American Express</option>
                </select>
            </div>
            <div class="form-group">
                <label for="bankName">Bank Name</label>
                <input type="text" class="form-control" id="bankName" name="bankName" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" class="form-control" id="cvv" name="cvv" required>
            </div>
            <div class="form-group">
                <label for="expirationMonth">Expiration Month</label>
                <input type="text" class="form-control" id="expirationMonth" name="expirationMonth" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit Payment</button>
        </form>
    </div>
</body>
</html>