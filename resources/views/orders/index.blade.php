@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-10 text-center text-indigo-600">Your Orders</h1>

        @if($orders->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border-collapse shadow-xl rounded-lg overflow-hidden">
                    <thead class="bg-indigo-600 text-white uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-4 px-6 text-left font-semibold">Order ID</th>
                        <th class="py-4 px-6 text-left font-semibold">Items</th>
                        <th class="py-4 px-6 text-left font-semibold">Total Price</th>
                        <th class="py-4 px-6 text-left font-semibold">Status</th>
                        <th class="py-4 px-6 text-left font-semibold">Placed At</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm divide-y divide-gray-200">
                    @foreach($orders as $order)
                        <tr class="hover:bg-indigo-50 transition-colors duration-200">
                            <td class="py-4 px-6 font-medium">{{ $order->id }}</td>
                            <td class="py-4 px-6">
                                @foreach(json_decode($order->items, true) as $item)
                                    <div class="mb-2">
                                        <span class="font-semibold">{{ $item['name'] }}</span>
                                        <span class="text-gray-500">(x{{ $item['quantity'] }})</span>
                                    </div>
                                @endforeach
                            </td>
                            <td class="py-4 px-6 font-semibold text-green-600">${{ number_format($order->total_price, 2) }}</td>
                            <td class="py-4 px-6">
                                <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full
                                {{ $order->status == 'completed' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-gray-500">{{ $order->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="flex justify-center items-center bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-lg shadow-lg">
                <p class="text-lg">You have no orders yet. Why not explore the <a href="{{ route('menu') }}" class="underline font-bold text-indigo-600">menu</a>?</p>
            </div>
        @endif
    </div>
@endsection
