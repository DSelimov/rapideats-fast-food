<?php

use App\Http\Controllers\FoodItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FoodItemController::class, 'index'])->name('pizzas');
Route::get('/pizzas/{id}', [FoodItemController::class, 'show'])->name('pizzas.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/cart', [OrderController::class, 'cart'])->name('cart');
    Route::post('/add-to-cart/{id}', [OrderController::class, 'addToCart'])->name('add.to.cart');
    Route::post('/remove-from-cart/{id}', [OrderController::class, 'removeFromCart'])->name('remove.from.cart');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/orders', [OrderController::class, 'orders'])->name('orders');
});

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    Route::get('/food-items', [\App\Http\Controllers\Admin\FoodItemController::class, 'index'])->name('admin.food-items.index');
    Route::get('/food-items/create', [App\Http\Controllers\Admin\FoodItemController::class, 'create'])->name('admin.food-items.create');
    Route::post('/food-items', [App\Http\Controllers\Admin\FoodItemController::class, 'store'])->name('admin.food-items.store');
    Route::get('/food-items/{foodItem}/edit', [App\Http\Controllers\Admin\FoodItemController::class, 'edit'])->name('admin.food-items.edit');
    Route::put('/food-items/{foodItem}', [App\Http\Controllers\Admin\FoodItemController::class, 'update'])->name('admin.food-items.update');
    Route::delete('/food-items/{foodItem}', [App\Http\Controllers\Admin\FoodItemController::class, 'destroy'])->name('admin.food-items.destroy');
    Route::get('/food-items/{id}', [App\Http\Controllers\Admin\FoodItemController::class, 'show'])->name('admin.food-items.show');

});

require __DIR__.'/auth.php';
