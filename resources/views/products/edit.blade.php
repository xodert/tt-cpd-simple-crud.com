@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <h2 class="text-2xl font-bold mb-6">Edit Product</h2>

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')
        @if(in_array(Auth::user()->role, config('roles.can-edit-articles', [])))
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="article">
                    Article
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('article') border-red-500 @enderror"
                       id="article"
                       type="text"
                       name="article"
                       value="{{ old('article', $product->article) }}"
                       required>
                @error('article')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        @else
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Article (Only admins can edit)
                </label>
                <div class="py-2 px-3 bg-gray-100 rounded">
                    {{ $product->article }}
                </div>
            </div>
        @endif

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Name
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                   id="name"
                   type="text"
                   name="name"
                   value="{{ old('name', $product->name) }}"
                   required>
            @error('name')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                Status
            </label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('status') border-red-500 @enderror"
                    id="status"
                    name="status"
                    required>
                <option value="available" {{ old('status', $product->status) === 'available' ? 'selected' : '' }}>Available</option>
                <option value="unavailable" {{ old('status', $product->status) === 'unavailable' ? 'selected' : '' }}>Unavailable</option>
            </select>
            @error('status')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                Price
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('data.price') border-red-500 @enderror"
                   id="price"
                   type="number"
                   step="0.01"
                   name="data[price]"
                   value="{{ old('data.price', $product->data['price']) }}"
                   required>
            @error('data.price')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="size">
                Size
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('data.size') border-red-500 @enderror"
                   id="size"
                   type="text"
                   name="data[size]"
                   value="{{ old('data.size', $product->data['size']) }}"
                   required>
            @error('data.size')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                Update Product
            </button>
            <a href="{{ route('products.index') }}"
               class="text-gray-600 hover:text-gray-900">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
