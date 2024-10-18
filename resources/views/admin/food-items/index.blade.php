@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-5">
        <h1 class="text-2xl font-semibold mb-10">Food Items Management</h1>

        <div class="mb-10">
            <a href="{{ route('admin.food-items.create') }}"    class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg
            hover:from-blue-600 hover:to-indigo-700 hover:shadow-xl transition-transform transform hover:scale-105 duration-300 ease-in-out">Add New Food Item</a>
        </div>

        @if(session('success'))
            <div class="bg-green-200 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if($foodItems->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 shadow-md">
                    <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 border-b">Image</th>
                        <th class="py-2 px-4 border-b">Name</th>
                        <th class="py-2 px-4 border-b">Description</th>
                        <th class="py-2 px-4 border-b">Price</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($foodItems as $item)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('admin.food-items.show', $item->id) }}">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-16 h-16 object-cover rounded">
                                </a>
                            </td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('admin.food-items.show', $item->id) }}" class="text-blue-600 hover:underline">{{ $item->name }}</a>
                            </td>
                            <td class="py-2 px-4 border-b">{{ Str::limit($item->description, 50) }}</td>
                            <td class="py-2 px-4 border-b">${{ number_format($item->price, 2) }}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('admin.food-items.edit', $item->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                                <form action="{{ route('admin.food-items.destroy', $item->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $foodItems->links() }}
            </div>
        @else
            <p class="mt-4">No food items available.</p>
        @endif
    </div>
@endsection
