@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-12">
        <div class="text-center mb-12">
            <h1 class="text-5xl font-extrabold text-gray-800">{{ $foodItem->name }}</h1>
            <p class="text-gray-500 mt-4">Discover our delicious and freshly made {{ $foodItem->name }}.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-12">
            <div class="bg-white p-6 rounded-lg shadow-lg transition hover:shadow-2xl">
                <img src="{{ asset('storage/' . $foodItem->image) }}" alt="{{ $foodItem->name }}" class="w-full h-80 object-cover rounded-lg mb-6">
            </div>

            <div class="bg-white p-8 rounded-lg shadow-lg transition hover:shadow-2xl">
                <h2 class="text-3xl font-semibold mb-4">Details</h2>

                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Description/Ingredients</h3>
                    <p class="text-gray-600">{{ $foodItem->description }}</p>
                </div>

                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Price</h3>
                    <p class="text-2xl text-black-800 font-bold">${{ number_format($foodItem->price, 2) }}</p>
                </div>
                <form action="{{ route('add.to.cart', $foodItem->id) }}" method="POST" class="mt-4 add-to-cart-form">
                    @csrf
                    <button type="submit"
                            class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg
            hover:from-blue-600 hover:to-indigo-700 hover:shadow-xl transition-transform transform hover:scale-105 duration-300 ease-in-out">
                        Add to Cart
                    </button>
                </form>

                <div class="add-to-cart-message text-green-500 mt-2 hidden">Pizza added to cart!</div>
            </div>
        </div>

        <!-- Similar Products Section -->
        <div class="mt-12">
            <h2 class="text-3xl font-bold mb-8">You May Also Like</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($randomPizza as $product)
                    <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-all duration-300 pb-10">
                        <a href="{{ route('pizzas.show', $product->id) }}">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-lg mb-4">
                        </a>
                        <h3 class="text-lg font-semibold">
                            <a href="{{ route('pizzas.show', $product->id) }}" class="hover:underline">{{ $product->name }}</a>
                        </h3>
                        <p class="text-gray-600 mt-2">{{ $product->description }}</p>
                        <p class="text-blue-600 font-semibold mt-2">${{ number_format($product->price, 2) }}</p>
                        <a href="{{ route('pizzas.show', $product->id) }}"
                           class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg
            hover:from-blue-600 hover:to-indigo-700 hover:shadow-xl transition-transform transform hover:scale-105 duration-300 ease-in-out">
                            View Details
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
