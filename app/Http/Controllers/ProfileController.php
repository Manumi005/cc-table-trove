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

            return redirect()->route('preorders.index')->with('success', 'Pre-order created successfully!');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error creating pre-order:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred while creating the pre-order.');
        }
    }

    // Show the form for editing a specific pre-order
    public function edit($id)
    {
        $preOrder = PreOrder::findOrFail($id);
        return view('customer.preorders.edit', compact('preOrder'));
    }

    // Update the specific pre-order
    public function update(Request $request, $id)
    {
        try {
            // Validate the incoming request
            $validatedData = $request->validate([
                'preorder_items' => 'required|array',
                'preorder_items.*.id' => 'required|integer',
                'preorder_items.*.name' => 'required|string',
                'preorder_items.*.price' => 'required|numeric',
                'preorder_items.*.quantity' => 'required|integer|min:1',
            ]);

            // Log the validated data
            Log::info('Validated PreOrder Items for update:', $validatedData);

            // Find the pre-order and update it
            $preOrder = PreOrder::findOrFail($id);
            $preOrder->update([
                'items' => json_encode($validatedData['preorder_items']),
                'updated_at' => now(), // Ensure timestamp is updated
            ]);

            return redirect()->route('preorders.index')->with('success', 'Pre-order updated successfully!');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error updating pre-order:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred while updating the pre-order.');
        }
    }

    // Delete the specific pre-order
    public function destroy($id)
    {
        try {
            // Find the pre-order and delete it
            $preOrder = PreOrder::findOrFail($id);
            $preOrder->delete();

            return redirect()->route('preorders.index')->with('success', 'Pre-order deleted successfully!');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error deleting pre-order:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred while deleting the pre-order.');
        }
    }

    // Submit pre-orders (newly added method)
    public function submit(Request $request)
    {
        try {
            // Validate the incoming request
            $validatedData = $request->validate([
                'preorder_items' => 'required|array',
                'preorder_items.*.id' => 'required|integer',
                'preorder_items.*.name' => 'required|string',
                'preorder_items.*.price' => 'required|numeric',
                'preorder_items.*.quantity' => 'required|integer|min:1',
            ]);

            // Process the pre-order submission
            // Example: Store the pre-order in the database
            PreOrder::create([
                'items' => json_encode($validatedData['preorder_items']),
            ]);

            return redirect()->route('preorders.index')->with('success', 'Pre-order submitted successfully!');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error submitting pre-order:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred while submitting the pre-order.');
        }
    }
}
