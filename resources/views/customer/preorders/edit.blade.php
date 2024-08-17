<!-- resources/views/customer/preorders/edit.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pre-Order</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Pre-Order</h1>
        <form action="{{ route('preorder.update', $preOrder->id) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Add form fields for pre-order items here -->
            <button type="submit" class="btn btn-success">Update</button>
</form>
    </div>
</body>a
</html>