<?php

namespace App\Http\Controllers;

use App\Models\FoodItem;
use App\Models\Order;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class OrderController extends Controller
{
    /**
     * @return Factory|View|Application
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function cart()
    {
        $cart = session()->get('cart', []);
        $totalPrice = array_sum(array_column($cart, 'total'));

        return view('orders.cart', compact('cart', 'totalPrice'));
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function addToCart($id)
    {
        $foodItem = FoodItem::find($id);

        if (!$foodItem) {
            return response()->json(['success' => false, 'message' => 'Item not found'], 404);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            $cart[$id]['total'] += $foodItem->price;
        } else {
            $cart[$id] = [
                'name' => $foodItem->name,
                'price' => $foodItem->price,
                'quantity' => 1,
                'total' => $foodItem->price,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Pizza added to cart!',
            'cartItem' => $cart[$id],
            'cartCount' => count($cart),
        ]);
    }


    /**
     * @param $id
     * @return RedirectResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart')->with('success', 'Item removed from cart.');
    }

    /**
     * @return RedirectResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $order = new Order();
        $order->user_id = auth()->id();
        $order->items = json_encode($cart);
        $order->total_price = array_sum(array_column($cart, 'total'));
        $order->status = 'pending';
        $order->save();

        session()->forget('cart');

        return redirect()->route('orders')->with('success', 'Order placed successfully.');
    }

    /**
     * @return Factory|View|Application
     */
    public function orders()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return view('orders.index', compact('orders'));
    }
}
