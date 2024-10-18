@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h2 class="text-center text-4xl font-bold mb-20">Explore Our Delicious Menu!</h2>

        <div class="flex justify-between mb-8">
            <!-- Search Form -->
            <form action="{{ route('pizzas') }}" method="GET" class="flex items-center space-x-2">
                <input type="text" name="search" placeholder="Search for pizzas..."
                       class="border rounded-lg p-2 w-64 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ request()->input('search') }}">
                <button type="submit" class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg hover:from-blue-600 hover:to-indigo-700 hover:shadow-xl transition-transform transform hover:scale-105 duration-300 ease-in-out">
                    Search
                </button>
            </form>

            <!-- Sort Form -->
            <form action="{{ route('pizzas') }}" method="GET" class="flex items-center space-x-2">
                <label for="sort_by" class="mr-2">Sort by:</label>
                <select name="sort_by" id="sort_by" onchange="this.form.submit()">
                    <option value="name" {{ request()->input('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="price" {{ request()->input('sort_by') == 'price' ? 'selected' : '' }}>Price</option>
                </select>
                <select name="sort_order" id="sort_order" onchange="this.form.submit()">
                    <option value="asc" {{ request()->input('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ request()->input('sort_order') == 'desc' ? 'selected' : '' }}>Descending</option>
                </select>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($foodItems as $item)
                <div class="bg-white rounded-b-2xl border-4 shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-105">
                    <a href="{{ route('pizzas.show', $item->id) }}">
                        <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-48 object-cover" alt="{{ $item->name }}">
                    </a>
                    <div class="p-4">
                        <h5 class="text-lg font-semibold">
                            <a href="{{ route('pizzas.show', $item->id) }}" class="hover:underline">{{ $item->name }}</a>
                        </h5>
                        <p class="text-gray-700 mt-1">{{ $item->description }}</p>
                        <p class="text-blue-600 font-semibold mt-2"><strong>Price: {{ $item->price }} lv</strong></p>
                        <form action="{{ route('add.to.cart', $item->id) }}" method="POST" class="mt-4 add-to-cart-form">
                            @csrf
                            <button type="submit" class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg hover:from-blue-600 hover:to-indigo-700 hover:shadow-xl transition-transform transform hover:scale-105 duration-300 ease-in-out">
                                Add to Cart
                            </button>
                        </form>
                        <div class="add-to-cart-message text-green-500 mt-2 hidden">Pizza added to cart!</div>
                        <a href="{{ route('pizzas.show', $item->id) }}" class="mt-2 inline-block bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg hover:from-blue-600 hover:to-indigo-700 hover:shadow-xl transition-transform transform hover:scale-105 duration-300 ease-in-out">
                            Read More
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
