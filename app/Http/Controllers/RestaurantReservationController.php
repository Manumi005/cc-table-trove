<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class RestaurantReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::where('restaurant_id', auth()->user()->id)->get();
        return view('restaurant.reservations', compact('reservations'));
    }
    
    public function approve($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'Approved';
        $reservation->save();
    
        return redirect()->route('restaurant.reservation.index')->with('status', 'Reservation approved successfully.');
    }
    
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
    
        return redirect()->route('restaurant.reservation.index')->with('status', 'Reservation deleted successfully.');
    }
}
    