@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-4xl font-bold text-center mb-6">{{ $foodItem->name }}</h1>

        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
            <img src="{{ asset('storage/' . $foodItem->image) }}" alt="{{ $foodItem->name }}" class="w-full h-64 object-cover rounded-md mb-4">

            <h2 class="text-2xl font-semibold mb-2">Description</h2>
            <p class="text-gray-700 mb-4">{{ $foodItem->description }}</p>

            <h2 class="text-2xl font-semibold mb-2">Price</h2>
            <p class="text-gray-700 mb-4">${{ number_format($foodItem->price, 2) }}</p>

            <div class="flex justify-between mt-6">
                <a href="{{ route('admin.food-items.edit', $foodItem->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update</a>
                <form action="{{ route('admin.food-items.destroy', $foodItem->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
