@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">Add New Pizza</h1>

        <form action="{{ route('admin.food-items.store') }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg space-y-6">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold text-lg mb-2">Food Name</label>
                <input type="text" name="name" id="name" class="form-input mt-1 block w-full border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500 text-gray-800 p-2" placeholder="Enter food name" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold text-lg mb-2">Description</label>
                <textarea name="description" id="description" class="form-textarea mt-1 block w-full border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500 text-gray-800 p-2" rows="4" placeholder="Write a short description" required></textarea>
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-semibold text-lg mb-2">Price</label>
                <input type="number" name="price" id="price" class="form-input mt-1 block w-full border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500 text-gray-800 p-2" step="0.01" placeholder="Enter price" required>
            </div>

            <div class="mb-6">
                <label for="image" class="block text-gray-700 font-semibold text-lg mb-2">Upload Image</label>
                <input type="file" name="image" id="image" class="form-input mt-1 block w-full border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500 p-2" accept="image/*" required onchange="previewImage(event)">
            </div>

            <div class="mb-6">
                <img id="image-preview" class="hidden w-full h-48 object-cover rounded-md shadow-md" />
            </div>

            <button type="submit" class="w-full  bg-gradient-to-r from-blue-500 to-indigo-600 py-3 px-6 shadow-lg
            hover:from-blue-600 hover:to-indigo-700 hover:shadow-xl  transform hover:scale-105  ease-in-out text-white font-semibold rounded-md hover:bg-blue-700 transition duration-200">
                Add New Pizza
            </button>
        </form>
    </div>


@endsection
