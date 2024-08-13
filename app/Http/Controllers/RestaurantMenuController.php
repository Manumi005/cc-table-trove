<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RestaurantMenuController extends Controller
{
    /**
     * Display a listing of the menu items for the authenticated restaurant.
     */
    public function index()
    {
        $menus = Menu::where('restaurant_id', Auth::id())->get();
        return view('restaurant.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new menu item.
     */
    public function create()
    {
        return view('restaurant.menu.create');
    }

    /**
     * Store a newly created menu item in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|array',
            'category.*' => 'string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'allergens' => 'nullable|array',
            'allergens.*' => 'string',
            'dietary' => 'nullable|array',
            'dietary.*' => 'string',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('menu_images', 'public');
        }

        $validated['restaurant_id'] = Auth::id();
        // Encode arrays to JSON for storage
        $validated['category'] = json_encode($validated['category']);
        $validated['allergens'] = json_encode($validated['allergens']);
        $validated['dietary'] = isset($validated['dietary']) ? json_encode($validated['dietary']) : json_encode([]);

        Menu::create($validated);

        return redirect()->route('restaurant.menu.index')->with('success', 'Menu item added.');
    }

    /**
     * Show the form for editing the specified menu item.
     */
    public function edit(Menu $menu)
    {
        // Decode JSON arrays for use in the edit form
        $menu->category = json_decode($menu->category, true) ?? [];
        $menu->allergens = json_decode($menu->allergens, true) ?? [];
        $menu->dietary = json_decode($menu->dietary, true) ?? [];

        return view('restaurant.menu.edit', compact('menu'));
    }

    /**
     * Update the specified menu item in the database.
     */
    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|array',
            'category.*' => 'string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'allergens' => 'nullable|array',
            'allergens.*' => 'string',
            'dietary' => 'nullable|array',
            'dietary.*' => 'string',
        ]);

        if ($request->hasFile('image')) {
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $validated['image'] = $request->file('image')->store('menu_images', 'public');
        } else {
            // Keep existing image if no new file is uploaded
            $validated['image'] = $menu->image;
        }

        // Encode arrays to JSON for storage
        if (isset($validated['category'])) {
            $validated['category'] = json_encode($validated['category']);
        }
        if (isset($validated['allergens'])) {
            $validated['allergens'] = json_encode($validated['allergens']);
        }
        if (isset($validated['dietary'])) {
            $validated['dietary'] = json_encode($validated['dietary']);
        }

        $menu->update($validated);

        return redirect()->route('restaurant.menu.index')->with('success', 'Menu item updated.');
    }

    /**
     * Remove the specified menu item from the database.
     */
    public function destroy(Menu $menu)
    {
        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }
        $menu->delete();
        return redirect()->route('restaurant.menu.index')->with('success', 'Menu item deleted.');
    }
}
