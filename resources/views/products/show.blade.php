@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="p-6">
        <div class="flex justify-between items-start">
            <h2 class="text-2xl font-bold mb-6">Product Details</h2>
            <div class="space-x-2">
                <a href="{{ route('products.edit', $product) }}"
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('products.index') }}"
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <img src="https://placehold.co/400x400" alt="Product" class="w-full rounded-lg object-cover">
            </div>

            <div class="space-y-4">
                <div>
                    <h3 class="text-gray-500 text-sm">Article</h3>
                    <p class="text-lg font-semibold">{{ $product->article }}</p>
                </div>

                <div>
                    <h3 class="text-gray-500 text-sm">Name</h3>
                    <p class="text-lg font-semibold">{{ $product->name }}</p>
                </div>

                <div>
                    <h3 class="text-gray-500 text-sm">Status</h3>
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                        {{ $product->status === 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $product->status }}
                    </span>
                </div>

                <div>
                    <h3 class="text-gray-500 text-sm">Price</h3>
                    <p class="text-lg font-semibold">${{ number_format($product->data['price'], 2) }}</p>
                </div>

                <div>
                    <h3 class="text-gray-500 text-sm">Size</h3>
                    <p class="text-lg font-semibold">{{ $product->data['size'] }}</p>
                </div>

                <div>
                    <h3 class="text-gray-500 text-sm">Created At</h3>
                    <p class="text-lg font-semibold">{{ $product->created_at->format('Y-m-d H:i:s') }}</p>
                </div>

                <div>
                    <h3 class="text-gray-500 text-sm">Last Updated</h3>
                    <p class="text-lg font-semibold">{{ $product->updated_at->format('Y-m-d H:i:s') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
