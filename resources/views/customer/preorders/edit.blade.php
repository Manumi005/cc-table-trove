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

        <!-- Display validation errors -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('preorders.update', $preOrder->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="preorder_items">Pre-Order Items</label>
                <div id="preorder_items">
                    @foreach($preOrder->items as $index => $item) <!-- No need for json_decode() -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <label for="preorder_items_{{ $index }}_name">Item Name</label>
                                        <input type="text" name="preorder_items[{{ $index }}][name]" class="form-control" value="{{ old("preorder_items.$index.name", $item['name']) }}" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="preorder_items_{{ $index }}_quantity">Quantity</label>
                                        <input type="number" name="preorder_items[{{ $index }}][quantity]" class="form-control" value="{{ old("preorder_items.$index.quantity", $item['quantity']) }}" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="preorder_items_{{ $index }}_price">Price</label>
                                        <input type="number" step="0.01" name="preorder_items[{{ $index }}][price]" class="form-control" value="{{ old("preorder_items.$index.price", $item['price']) }}" required>
                                    </div>
                                    <input type="hidden" name="preorder_items[{{ $index }}][id]" value="{{ $item['id'] }}">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</body>
</html>
