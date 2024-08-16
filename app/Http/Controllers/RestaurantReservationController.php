<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class RestaurantReservationController extends Controller
{
    public function index()
    {
        // Fetch reservations with their related restaurant and customer data
        $reservations = Reservation::with('restaurant', 'customer')
            ->where('restaurant_id', auth()->user()->id)
            ->get();
            
        // Update reservation statuses where the reservation date has passed
        foreach ($reservations as $reservation) {
            if ($reservation->reservation_date < now()->toDateString() && $reservation->status == 'Pending') {
                $reservation->status = 'Expired'; // Or another status to indicate past date
                $reservation->save();
            }
        }

        return view('restaurant.reservations', compact('reservations'));
    }

    public function approve($id)
    {
        $reservation = Reservation::findOrFail($id);
        
        // Check if the reservation is already expired
        if ($reservation->reservation_date < now()->toDateString()) {
            return redirect()->route('restaurant.reservation.index')
                ->with('error', 'Reservation cannot be approved as it has already expired.');
        }
        
        $reservation->status = 'Approved';
        $reservation->save();
    
        return redirect()->route('restaurant.reservation.index')
            ->with('status', 'Reservation approved successfully.');
    }
    
    public function cancel($id)
    {
        $reservation = Reservation::findOrFail($id);

        // Check if the reservation is already expired
        if ($reservation->reservation_date < now()->toDateString()) {
            return redirect()->route('restaurant.reservation.index')
                ->with('error', 'Reservation cannot be cancelled as it has already expired.');
        }
    
        $reservation->status = 'Cancelled';
        $reservation->save();
    
        return redirect()->route('restaurant.reservation.index')
            ->with('status', 'Reservation cancelled successfully.');
    }
    
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);

        // Check if the reservation is already expired
        if ($reservation->reservation_date < now()->toDateString()) {
            return redirect()->route('restaurant.reservation.index')
                ->with('error', 'Reservation cannot be deleted as it has already expired.');
        }
    
        $reservation->delete();
    
        return redirect()->route('restaurant.reservation.index')
            ->with('status', 'Reservation deleted successfully.');
    }
}
