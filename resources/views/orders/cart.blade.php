@extends('layouts.app')

@section('content')
    <div class="container mx-auto my-8">
        <h1 class="text-3xl font-bold text-center mb-6">Your Favorite Pizzas Are Just a Click Away!</h1>

        @if(session('cart') && count(session('cart')) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead>
                    <tr style="background-color: #7b5b68; background-image: linear-gradient(305deg, #7b5b68 0%, #83511f 1%, #2B86C5 17%);" class="text-white text-lg">
                        <th class="py-2 px-4 text-left">Pizza</th>
                        <th class="py-2 px-4 text-left">Quantity</th>
                        <th class="py-2 px-4 text-left">Price</th>
                        <th class="py-2 px-4 text-left">Total</th>
                        <th class="py-2 px-4 text-left">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(session('cart') as $id => $details)
                        <tr class="border-b text-lg">
                            <td class="py-3 px-4">{{ $details['name'] }}</td>
                            <td class="py-3 px-4">{{ $details['quantity'] }}</td>
                            <td class="py-3 px-4">${{ number_format($details['price'], 2) }}</td>
                            <td class="py-3 px-4">${{ number_format($details['total'], 2) }}</td>
                            <td class="py-3 px-4">
                                <form action="{{ route('remove.from.cart', $id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end mt-4">
                <h4 class="text-xl font-semibold text-lg">Total Price: ${{ number_format($totalPrice, 2) }}</h4>
                <form action="{{ route('checkout') }}" method="POST" class="ml-4">
                    @csrf
                    <button type="submit"  class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg
            hover:from-blue-600 hover:to-indigo-700 hover:shadow-xl transition-transform transform hover:scale-105 duration-300 ease-in-out">Checkout</button>
                </form>
            </div>
        @else
            <p class="text-center text-gray-500 mt-4">Your cart is empty.</p>
        @endif
    </div>
@endsection
