<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // Show reservation creation form for customers
    public function create()
    {
        return view('customer.reservation');
    }

    // Handle reservation creation
    public function store(Request $request)
    {
        $request->validate([
            'reservation_date' => 'required|date',
            'time_slot' => 'required',
            'party_size' => 'required|integer|min:1|max:20',
            'restaurant_id' => 'required|exists:restaurants,id',
        ]);

        $reservation = new Reservation();
        $reservation->user_id = Auth::id(); // Assuming Auth is for customer
        $reservation->reservation_date = $request->reservation_date;
        $reservation->time_slot = $request->time_slot;
        $reservation->party_size = $request->party_size;
        $reservation->status = 'pending'; // Default status
        $reservation->restaurant_id = $request->restaurant_id; // Set restaurant_id
        $reservation->save();

        return redirect()->route('customer.reservation.create')->with('success', 'Reservation made successfully!');
    }

    // List all reservations for the restaurant
    public function index()
    {
        $reservations = Reservation::where('restaurant_id', Auth::user()->id)->get();
        return view('restaurant.reservation', compact('reservations'));
    }

    // Handle reservation approval
    public function approve($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'approved';
        $reservation->save();

        return redirect()->back()->with('success', 'Reservation approved');
    }
}