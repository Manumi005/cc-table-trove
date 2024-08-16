<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Restaurant;

class CustomerReservationController extends Controller
{
    // Display a listing of the reservations for the authenticated user
    public function index()
    {
        // Fetch all reservations for the authenticated user
        $reservations = Reservation::where('user_id', auth()->id())->get();

        // Return the index view with the reservations data
        return view('customer.reservations.index', compact('reservations'));
    }

    // Show the form for creating a new reservation
    public function create()
    {
        // Fetch all restaurants to display in the form
        $restaurants = Restaurant::all();

        // Return the create view with the restaurants data
        return view('customer.reservations.create', compact('restaurants'));
    }

    // Store a newly created reservation in the database
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'restaurant_id' => 'required|integer|exists:restaurants,id',
            'reservation_date' => 'required|date',
            'time_slot' => ['required', 'regex:/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/'],
            'party_size' => 'required|integer|min:1',
        ]);

        // Create a new reservation record
        Reservation::create([
            'user_id' => auth()->id(),
            'restaurant_id' => $request->restaurant_id,
            'reservation_date' => $request->reservation_date,
            'time_slot' => $request->time_slot,
            'party_size' => $request->party_size,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect to the reservations index page with a success message
        return redirect()->route('customer.reservations.index')->with('success', 'Reservation created successfully.');
    }

    // Display the specified reservation
    public function show($id)
    {
        // Fetch the reservation for the authenticated user
        $reservation = Reservation::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        // Return the show view with the reservation data
        return view('customer.reservations.show', compact('reservation'));
    }

    // Remove the specified reservation from the database
    public function destroy($id)
    {
        // Fetch the reservation for the authenticated user
        $reservation = Reservation::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        // Delete the reservation
        $reservation->delete();

        // Redirect to the reservations index page with a success message
        return redirect()->route('customer.reservations.index')->with('success', 'Reservation cancelled successfully.');
    }
}
