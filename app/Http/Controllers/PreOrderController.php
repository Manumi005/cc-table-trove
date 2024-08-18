<?php

namespace App\Http\Controllers;

use App\Models\PreOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PreOrderController extends Controller
{
    // Display all pre-orders
    public function index()
    {
        $preOrders = PreOrder::all();
        return view('customer.preorders.index', compact('preOrders'));
    }

    // Show the form for creating a new pre-order
    public function create()
    {
        return view('customer.preorders.create');
    }

    // Store a new pre-order
    public function store(Request $request)
    {
        try {
            // Validate the incoming request
            $validatedData = $request->validate([
                'item_name' => 'required|string|max:255',
                'quantity' => 'required|integer|min:1',
                'price' => 'required|numeric|min:0',
            ]);

            // Create a new pre-order
            PreOrder::create([
                'items' => json_encode([[
                    'name' => $validatedData['item_name'],
                    'quantity' => $validatedData['quantity'],
                    'price' => $validatedData['price'],
                ]]),
            ]);

            return redirect()->route('customer.preorders.index')->with('success', 'Pre-order submitted successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error storing pre-order:', ['error' => $e->getMessage()]);
            return redirect()->route('customer.preorders.create')->withErrors(['error' => 'An error occurred while submitting the pre-order.']);
        }
    }
}
