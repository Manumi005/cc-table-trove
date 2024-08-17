@extends('layouts.app')

@section('content')
    <h1>Pre-Orders</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Items</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($preOrders as $preOrder)
                <tr>
                    <td>{{ $preOrder->id }}</td>
                    <td>{{ json_encode($preOrder->items) }}</td>
                    <td>
                        <a href="{{ route('preorders.edit', $preOrder->id) }}">Edit</a>
                        <form action="{{ route('preorders.destroy', $preOrder->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection