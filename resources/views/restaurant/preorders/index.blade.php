<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preorders</title>
</head>
<body>
    <h1>Preorders</h1>
    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Items</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($preOrders as $preOrder)
                <tr>
                    <td>{{ $preOrder->id }}</td>
                    <td>{{ $preOrder->customer_name }}</td>
                    <td>
                        <ul>
                            @foreach ($preOrder->items as $item)
                                <li>{{ $item->name }} - {{ $item->quantity }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $preOrder->total_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
