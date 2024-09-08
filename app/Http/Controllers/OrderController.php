<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function approveOrder(Request $request)
    {
        // Logic to approve the order
        return redirect()->route('orderSummary')->with('orderStatus', 'Order and Payment Successfully Completed. Thank you so much for your order & enjoy our delicious food!');
    }

    public function cancelOrder(Request $request)
    {
        // Logic to cancel the order
        return redirect()->route('orderSummary')->with('orderStatus', 'Sorry, your order is not approved. We will return the money within 5 working days.');
    }
}