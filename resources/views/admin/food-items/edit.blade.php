@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-4xl font-bold text-center mb-6">Edit Food Item</h1>

        <form action="{{ route('admin.food-items.update', $foodItem->id) }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="name" class="block text-gray-700 text-sm font-semibold mb-2">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $foodItem->name) }}" class="form-input mt-1 block w-full border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200" required>
            </div>

            <div class="mb-6">
                <label for="description" class="block text-gray-700 text-sm font-semibold mb-2">Description</label>
                <textarea name="description" id="description" class="form-textarea mt-1 block w-full border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200" rows="4" required>{{ old('description', $foodItem->description) }}</textarea>
            </div>

            <div class="mb-6">
                <label for="price" class="block text-gray-700 text-sm font-semibold mb-2">Price</label>
                <input type="number" name="price" id="price" value="{{ old('price', $foodItem->price) }}" class="form-input mt-1 block w-full border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200" step="0.01" required>
            </div>

            <div class="mb-6">
                <label for="image" class="block text-gray-700 text-sm font-semibold mb-2">Image (Leave blank to keep current image)</label>
                <input type="file" name="image" id="image" class="form-input mt-1 block w-full border border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200">
                @if ($foodItem->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $foodItem->image) }}" alt="Current Image" class="w-32 h-32 object-cover rounded-md">
                    </div>
                @endif
            </div>

            <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition duration-200">Update Food Item</button>
        </form>
    </div>
@endsection
