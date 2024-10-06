<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Show the payment page
    public function showPaymentPage($restaurantId, $reservationId)
    {
        // Find the reservation
        $reservation = Reservation::find($reservationId);

        // If the reservation doesn't exist, return with an error message
        if (!$reservation) {
            return redirect()->back()->with('message', 'Reservation not found.');
        }

        // Pass the reservation data to the view
        return view('customer.payment', compact('reservation'));
    }

    // Process the payment
    public function processPayment(Request $request)
    {
        // Validate the payment fields
        $request->validate([
            'cardNumber' => 'required|digits:16',
            'cardName' => 'required|string|max:255',
            'cardType' => 'required',
            'cvv' => 'required|digits_between:3,4',
            'expirationMonth' => 'required',
            'expirationYear' => 'required',
        ]);

        // Find the reservation by its ID
        $reservation = Reservation::find($request->input('reservationId'));

        // Check if the reservation exists
        if (!$reservation) {
            return redirect()->back()->with('message', 'Reservation not found.');
        }

        // Update the payment_status to true
        $reservation->payment_status = true;
        $reservation->save();

        // Redirect with a success message
        return redirect()->back()->with('message', 'Payment successful!');
    }
}
