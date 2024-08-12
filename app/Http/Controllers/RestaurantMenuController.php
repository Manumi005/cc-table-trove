<?php
namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class RestaurantMenuController extends Controller
{
    public function index()
    {
        $menus = Menu::where('restaurant_id', auth()->id())->get();
        return view('restaurant.menu.index', compact('menus'));
    }

    public function create()
    {
        return view('restaurant.menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image',
            'allergens' => 'nullable|array',
        ]);

        $data = $request->only(['name', 'description', 'price', 'allergens']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $data['restaurant_id'] = auth()->id();
        Menu::create($data);

        return redirect()->route('restaurant.menu.index')->with('success', 'Menu item added.');
    }

    public function edit(Menu $menu)
    {
        return view('restaurant.menu.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image',
            'allergens' => 'nullable|array',
        ]);

        $data = $request->only(['name', 'description', 'price', 'allergens']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $menu->update($data);

        return redirect()->route('restaurant.menu.index')->with('success', 'Menu item updated.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('restaurant.menu.index')->with('success', 'Menu item deleted.');
    }
}
