<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'review' => 'required|string|max:255',
            'restaurant_id' => 'required|integer|exists:restaurants,id',
            'user_name' => 'required|string|max:255', // Validate user_name
        ]);

        // Create a new review
        Review::create([
            'restaurant_id' => $request->restaurant_id,
            'user_name' => $request->user_name, // Use the user_name from the request
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        // Redirect to the restaurant details page with success message
        return redirect()->back()->with('success', 'Review submitted successfully!');
    }

    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $reviews = Review::where('restaurant_id', $id)->get();

        return view('customer.restaurant-details', compact('restaurant', 'reviews'));
    }
    public function index($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        // Use the passed restaurant ID to fetch reviews
        $reviews = Review::where('restaurant_id', $id)->get();
        return view('restaurant.reviews', compact('reviews'));
    }

    public function flag($id)
    {
        $review = Review::findOrFail($id);
        $review->flag_status = 1; // Set the flag status to 1 (flagged)
        $review->save();

        return redirect()->back()->with('success', 'Review flagged successfully!');
    }

    public function unflag($id)
    {
        $review = Review::findOrFail($id);
        $review->flag_status = 0; // Set the flag status to 1 (flagged)
        $review->save();

        return redirect()->back()->with('success', 'Review unflagged successfully!');
    }



}
