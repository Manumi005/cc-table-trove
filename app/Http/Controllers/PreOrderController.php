<?php

namespace App\Http\Controllers;

use App\Models\PreOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PreOrderController extends Controller
{
    public function index()
    {
        $preOrders = PreOrder::all();
        return view('customer.preorders.index', compact('preOrders'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'preorder_items' => 'required|array',
                'preorder_items.*.id' => 'required|integer',
                'preorder_items.*.name' => 'required|string',
                'preorder_items.*.price' => 'required|numeric',
                'preorder_items.*.quantity' => 'required|integer|min:1',
            ]);

            Log::info('Validated PreOrder Items:', $validatedData);

            $preOrderItems = $request->input('preorder_items');
            PreOrder::create(['items' => json_encode($preOrderItems)]);

            return redirect()->back()->with('success', 'Pre-order submitted successfully!');
        } catch (\Exception $e) {
            Log::error('Error submitting pre-order:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred while submitting the pre-order.');
        }
    }

    public function create()
    {
        return view('customer.preorders.create');
    }

    public function edit($id)
    {
        $preOrder = PreOrder::findOrFail($id);
        return view('customer.preorders.edit', compact('preOrder'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'preorder_items' => 'required|array',
                'preorder_items.*.id' => 'required|integer',
                'preorder_items.*.name' => 'required|string',
                'preorder_items.*.price' => 'required|numeric',
                'preorder_items.*.quantity' => 'required|integer|min:1',
            ]);

            Log::info('Validated PreOrder Items for update:', $validatedData);

            $preOrder = PreOrder::findOrFail($id);
            $preOrder->update(['items' => json_encode($request->input('preorder_items'))]);

            return redirect()->route('preorders.index')->with('success', 'Pre-order updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating pre-order:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred while updating the pre-order.');
        }
    }

    public function showPreOrder()
    {
        return view('customer.preorders.preorder');
    }
}
