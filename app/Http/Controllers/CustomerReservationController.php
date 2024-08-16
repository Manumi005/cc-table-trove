<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Restaurant;

class CustomerReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::where('user_id', auth()->id())->get();
        return view('customer.reservations.index', compact('reservations'));
    }

    public function create()
    {
        $restaurants = Restaurant::all();
        return view('customer.reservations.create', compact('restaurants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'restaurant_id' => 'required|integer|exists:restaurants,id',
            'reservation_date' => 'required|date',
            'time_slot' => ['required', 'regex:/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/'],
            'party_size' => 'required|integer',
        ]);

        Reservation::create([
            'user_id' => auth()->id(),
            'restaurant_id' => $request->restaurant_id,
            'reservation_date' => $request->reservation_date,
            'time_slot' => $request->time_slot,
            'party_size' => $request->party_size,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('customer.reservations.index')->with('success', 'Reservation created successfully.');
    }

    public function show($id)
    {
        $reservation = Reservation::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        return view('customer.reservations.show', compact('reservation'));
    }

    public function destroy($id)
    {
        $reservation = Reservation::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $reservation->delete();
        return redirect()->route('customer.reservations.index')->with('success', 'Reservation cancelled successfully.');
    }
}
