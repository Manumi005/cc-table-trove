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
        // Code for storing a new pre-order can be added here
    }

    // Submit the pre-order
    public function submitPreOrder(Request $request)
    {
        try {
            $preOrderItems = $request->input('preorder_items');

            // Validate the pre-order items
            $validated = $request->validate([
                'preorder_items' => 'required|array',
                'preorder_items.*.menu_item_id' => 'required|integer',
                'preorder_items.*.quantity' => 'required|integer|min:1',
                'preorder_items.*.price' => 'required|numeric',
                'preorder_items.*.total_price' => 'required|numeric',
                'preorder_items.*.user_id' => 'required|integer',
            ]);

            if (empty($preOrderItems)) {
                return response()->json(['success' => false, 'message' => 'No items in pre-order.']);
            }

            // Save pre-order to the database
            $preOrder = new PreOrder();
            $preOrder->items = $preOrderItems;
            $preOrder->user_id = auth()->id(); // Assuming you want to save the user who made the pre-order
            $preOrder->save();

            // Store pre-order items in the session to show in the summary
            session(['preOrderItems' => $preOrderItems]);

            return response()->json(['success' => true, 'message' => 'Pre-order submitted successfully!', 'redirect_url' => route('preorder.summary')]);
        } catch (\Exception $e) {
            Log::error('Error submitting pre-order:', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Error submitting pre-order.']);
        }
    }

    // Display the pre-order summary
    public function summary()
    {
        $preOrderItems = session('preOrderItems', []);
        return view('customer.preorders.summary', compact('preOrderItems'));
    }
}
