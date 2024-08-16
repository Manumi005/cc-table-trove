<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CustomerReservationController extends Controller
{
    /**
     * Display a listing of the user's reservations.
     *
     * @return View
     */
    public function index(): View
    {
        $reservations = Reservation::where('customer_id', Auth::id())->get();
        return view('customer.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new reservation.
     *
     * @return View
     */
    public function create(): View
    {
        $restaurants = Restaurant::all();
        return view('customer.reservations.create', compact('restaurants'));
    }

    /**
     * Store a newly created reservation in the database.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'restaurant_id' => 'required|integer|exists:restaurants,id',
            'reservation_date' => 'required|date|after_or_equal:today',
            'time_slot' => ['required', 'regex:/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/'],
            'party_size' => 'required|integer|min:1',
        ], [
            'restaurant_id.required' => 'Please select a restaurant.',
            'restaurant_id.exists' => 'Selected restaurant does not exist.',
            'reservation_date.required' => 'Please select a reservation date.',
            'reservation_date.after_or_equal' => 'Reservation date must be today or a future date.',
            'time_slot.required' => 'Please select a time slot.',
            'time_slot.regex' => 'Time slot must be in HH:MM format (24-hour clock).',
            'party_size.required' => 'Please specify the party size.',
            'party_size.min' => 'Party size must be at least 1.',
        ]);

        Reservation::create([
            'customer_id' => Auth::id(),
            'restaurant_id' => $validated['restaurant_id'],
            'reservation_date' => $validated['reservation_date'],
            'time_slot' => $validated['time_slot'],
            'party_size' => $validated['party_size'],
        ]);

        return redirect()->route('customer.reservations.index')->with('success', 'Reservation created successfully.');
    }

    /**
     * Display the specified reservation.
     *
     * @param  int  $id
     * @return View
     */
    public function show(int $id): View
    {
        $reservation = Reservation::where('id', $id)
            ->where('customer_id', Auth::id())
            ->firstOrFail();

        return view('customer.reservations.show', compact('reservation'));
    }

    /**
     * Remove the specified reservation from the database.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $reservation = Reservation::where('id', $id)
            ->where('customer_id', Auth::id())
            ->firstOrFail();

        $reservation->delete();

        return redirect()->route('customer.reservations.index')->with('success', 'Reservation canceled successfully.');
    }
}

