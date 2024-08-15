<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Restaurant;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();
        return view('customer.reservations.index', compact('reservations'));
    }

    public function create()
    {
        // Fetch all restaurants
        $restaurants = Restaurant::all();

        // Pass the restaurants to the view
        return view('customer.reservations.create', compact('restaurants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'restaurant_id' => 'required|integer',
            'reservation_date' => 'required|date',
            'time_slot' => ['required', 'regex:/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/'],
            'party_size' => 'required|integer',
        ]);

        Reservation::create([
            'user_id' => $request->user_id,
            'restaurant_id' => $request->restaurant_id,
            'reservation_date' => $request->reservation_date,
            'time_slot' => $request->time_slot,
            'party_size' => $request->party_size,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
    }

    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('customer.reservations.show', compact('reservation'));
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Reservation cancelled successfully.');
    }
}