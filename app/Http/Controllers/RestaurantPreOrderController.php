<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreOrder;

class RestaurantPreOrderController extends Controller
{
    public function index()
    {
        $preOrders = PreOrder::all();
        return view('restaurant.preorders.index', compact('preOrders'));
    }

    public function create()
    {
        return view('restaurant.preorders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'items' => 'required|array',
            'total_price' => 'required|numeric',
        ]);

        PreOrder::create([
            'customer_name' => $request->customer_name,
            'items' => json_encode($request->items),
            'total_price' => $request->total_price,
        ]);

        return redirect()->route('preorders.index')->with('status', 'Pre-order created successfully!');
    }
    
    // Removed edit, update, and destroy methods as they are no longer needed
}
