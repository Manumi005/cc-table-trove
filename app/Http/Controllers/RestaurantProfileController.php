<?php
namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RestaurantProfileController extends Controller
{
    /**
     * Display the restaurant profile.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $restaurant = Auth::guard('restaurant')->user();
        return view('restaurant.profile', compact('restaurant'));
    }

    /**
     * Show the form for editing the restaurant profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $restaurant = Auth::guard('restaurant')->user();
        return view('restaurant.profile-edit', compact('restaurant'));
    }

    /**
     * Update the restaurant profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $this->validateRestaurant($request);

        $restaurant = Auth::guard('restaurant')->user();
        $this->saveRestaurantData($restaurant, $request);

        return redirect()->route('restaurant.profile.show')->with('success', 'Profile updated successfully.');
    }

    /**
     * Display the restaurant summary page.
     *
     * @return \Illuminate\View\View
     */
    public function showSummary()
    {
        $restaurant = Auth::guard('restaurant')->user();
        return view('restaurant.summary', compact('restaurant'));
    }

    /**
     * Display the details page for customers.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function showRestaurantDetails($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('customer.restaurant-details', compact('restaurant'));
    }

    /**
     * Show the form for creating a new restaurant.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('restaurant.create');
    }

    /**
     * Store a newly created restaurant in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validateRestaurant($request);

        $restaurant = new Restaurant();
        $this->saveRestaurantData($restaurant, $request);

        return redirect()->route('restaurant.summary')->with('success', 'Restaurant created successfully.');
    }

    /**
     * Remove the specified restaurant from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);

        if ($restaurant->image && Storage::exists($restaurant->image)) {
            Storage::delete($restaurant->image);
        }

        $restaurant->delete();

        return redirect()->route('restaurant.dashboard')->with('success', 'Restaurant deleted successfully.');
    }

    /**
     * Validate the restaurant data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    private function validateRestaurant(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:restaurants,email,' . ($request->id ?? 'NULL') . ',id',
            'contact_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'cuisine_type' => 'nullable|array',
            'cuisine_type.*' => 'string|max:100',
            'opening_hours_start' => 'required|date_format:H:i',
            'opening_hours_end' => 'required|date_format:H:i',
            'details' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    }

    /**
     * Save the restaurant data.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    private function saveRestaurantData(Restaurant $restaurant, Request $request)
    {
        $restaurant->name = $request->input('name');
        $restaurant->email = $request->input('email');
        $restaurant->contact_number = $request->input('contact_number');
        $restaurant->address = $request->input('address');
        $restaurant->cuisine_type = json_encode($request->input('cuisine_type', []));
        $restaurant->opening_hours_start = $request->input('opening_hours_start');
        $restaurant->opening_hours_end = $request->input('opening_hours_end');
        $restaurant->details = $request->input('details');

        if ($request->hasFile('image')) {
            if ($restaurant->image && Storage::exists($restaurant->image)) {
                Storage::delete($restaurant->image);
            }
            $restaurant->image = $request->file('image')->store('public/restaurant_images');
        }

        $restaurant->save();
    }
}
