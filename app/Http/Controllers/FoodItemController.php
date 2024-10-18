<?php

namespace App\Http\Controllers;

use App\Models\FoodItem;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class FoodItemController extends Controller
{
    /**
     * Display a listing of food items, optionally filtered by search query
     * and sorted by specified column and order.
     *
     * @param Request $request The request instance containing search and sorting parameters.
     * @return Factory|View|Application The view displaying the food items.
     */
    public function index(Request $request): Factory|View|Application
    {
        $query = $request->input('search');
        $sortBy = $request->input('sort_by', 'name');
        $sortOrder = $request->input('sort_order', 'asc');

        $foodItems = FoodItem::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%");
        })
            ->orderBy($sortBy, $sortOrder)
            ->get();

        return view('pizzas.index', compact('foodItems'));
    }

    /**
     * Display the specified food item with additional random pizzas for recommendations.
     *
     * @param int $id The ID of the food item to display.
     * @return Factory|View|Application The view displaying the food item and recommendations.
     */
    public function show(int $id): Factory|View|Application
    {
        $foodItem  = FoodItem::findOrFail($id);
        $randomPizza = FoodItem::where('id', '!=', $id)->inRandomOrder()->take(3)->get();
        return view('pizzas.show', compact('foodItem', 'randomPizza'));
    }
}
