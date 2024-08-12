<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .dashboard-container {
            margin: 20px auto;
            max-width: 800px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        .section-title {
            color: #555;
            margin: 20px 0;
            font-size: 18px;
        }
        .feature-list {
            text-align: left;
            margin-bottom: 20px;
        }
        .feature-list li {
            margin-bottom: 10px;
        }
        .management-buttons {
            margin-top: 20px;
        }
        .management-buttons button {
            padding: 10px 20px;
            margin: 10px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .management-buttons button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <h1>Welcome to Restaurant Dashboard</h1>
        
        <div class="section-title">Restaurant Features:</div>
        <ul class="feature-list">
            <li><strong>Manage Restaurant Profile:</strong></li>
            <ul>
                <li>Restaurant sign-up and log-in process.</li>
                <li>Create and edit restaurant profile information (name, address, contact details, opening hours).</li>
                <li>Upload restaurant logo and images.</li>
            </ul>
            
            <li><strong>Create and Edit Menus:</strong></li>
            <ul>
                <li>Add new menu items with descriptions, prices, and images.</li>
                <li>Edit existing menu items (update descriptions, prices, availability).</li>
                <li>Organize menu items into categories (appetizers, mains, desserts).</li>
            </ul>
            
            <li><strong>Update Dietary Information and Allergen Warnings:</strong></li>
            <ul>
                <li>Include dietary labels (vegan, gluten-free, etc.) for each menu item.</li>
                <li>Add allergen information to menu items (nuts, dairy, etc.).</li>
                <li>Ensure that dietary and allergen information is prominently displayed.</li>
            </ul>
            
            <li><strong>Handle Reservations:</strong></li>
            <ul>
                <li>Allow restaurants to set available reservation slots.</li>
                <li>Enable customers to book reservations through the app.</li>
                <li>Provide restaurants with a reservation management interface (view, confirm, cancel reservations).</li>
            </ul>
            
            <li><strong>Manage Preorders:</strong></li>
            <ul>
                <li>Allow customers to place orders in advance.</li>
                <li>Provide an interface for restaurants to view and manage preorders.</li>
                <li>Send notifications to restaurants for new preorders.</li>
            </ul>
            
            <li><strong>Verify Payments:</strong></li>
            <ul>
                <li>Integrate payment gateway for handling customer payments.</li>
                <li>Ensure secure payment processing (credit card, mobile payment options).</li>
                <li>Implement payment verification and confirmation for restaurants.</li>
            </ul>
        </ul>

        <div class="management-buttons">
            <button onclick="location.href='/restaurant/profile'">Profile Management</button>
            <button onclick="location.href='/restaurant/restaurant'">Restaurant Management</button>
            <button onclick="location.href='{{ route('restaurant.menu.index') }}'">Menu Management</button>
            <button onclick="location.href='reservation-management.html'">Reservation Management</button>
            <button onclick="location.href='preorder-management.html'">Preorder Management</button>
            <button onclick="location.href='payment-verification.html'">Payment Verification</button>
        </div>
    </div>

</body>
</html>
