<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function showPaymentForm(Request $request)
    {
        $totalAmount = $request->query('totalAmount', '0.00');
        return view('payment', compact('totalAmount'));
    }

    public function processPayment(Request $request)
    {
        // Validate the request data
        $request->validate([
            'cardNumber' => 'required|digits:16',
            'cardName' => 'required|string',
            'cardType' => 'required|string',
            'bankName' => 'required|string',
            'cvv' => 'required|digits_between:3,4',
            'expirationMonth' => 'required|digits:2',
            'expirationYear' => 'required|digits:4',
        ]);

        // Simulate payment processing
        $paymentSuccess = rand(0, 1) == 1;
        $price = $request->input('totalAmount', '0.00');

        if ($paymentSuccess) {
            return redirect()->route('orderSummary')->with('message', 'Payment Successful')->with('price', $price);
        } else {
            return redirect()->back()->with('message', 'Sorry, your payment failed. Try again');
        }
    }
    public function showPaymentVerification()
    {
        // Logic to retrieve payment verification data if needed
        return view('restaurant.paymentVerification');
    }
    public function show()
    {
        return view('customer.payment');
    }
}
