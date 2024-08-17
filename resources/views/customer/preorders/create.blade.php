<!-- resources/views/customer/preorders/create.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Pre-Order</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Create Pre-Order</h1>
        <form action="{{ route('preorders.store') }}" method="POST">
            @csrf
            <!-- Add form fields for pre-order items here -->
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</body>
</html>