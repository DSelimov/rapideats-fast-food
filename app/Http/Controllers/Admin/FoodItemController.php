<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoodItem;
use Illuminate\Console\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodItemController extends Controller
{
    public function index()
    {
        $foodItems = FoodItem::paginate(5);
        return view('admin.food-items.index', compact('foodItems'));
    }

    public function create()
    {
        return view('admin.food-items.create');
    }

    public function show($id)
    {
        $foodItem  = FoodItem::findOrFail($id);

        $randomPizza = FoodItem::where('id', '!=', $id)->inRandomOrder()->take(3)->get();

        return view('admin.food-items.show', compact('foodItem', 'randomPizza'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        FoodItem::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.food-items.index')->with('success', 'Food item created successfully.');
    }

    public function edit(FoodItem $foodItem)
    {
        return view('admin.food-items.edit', compact('foodItem'));
    }

    public function update(Request $request, FoodItem $foodItem)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($foodItem->image) {
                Storage::disk('public')->delete($foodItem->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $foodItem->image = $imagePath;
        }

        $foodItem->name = $request->name;
        $foodItem->description = $request->description;
        $foodItem->price = $request->price;
        $foodItem->save();

        return redirect()->route('admin.food-items.index')->with('success', 'Food item updated successfully.');
    }

    public function destroy(FoodItem $foodItem)
    {
        if ($foodItem->image) {
            Storage::disk('public')->delete($foodItem->image);
        }

        $foodItem->delete();

        return redirect()->route('admin.food-items.index')->with('success', 'Food item deleted successfully.');
    }

}
