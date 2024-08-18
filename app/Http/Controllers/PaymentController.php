<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('customer.preorders.payment');
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'cardNumber' => 'required|digits:16',
            'cardName' => 'required|string',
            'cardType' => 'required|string',
            'bankName' => 'required|string',
            'cvv' => 'required|digits_between:3,4',
            'expirationMonth' => 'required|string',
        ]);

        // Process the payment here

        return redirect()->route('summary')->with('success', 'Payment processed successfully!');
    }
}