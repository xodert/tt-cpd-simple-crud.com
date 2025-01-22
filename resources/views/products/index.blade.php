@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div class="flex flex-col sm:flex-row gap-4 flex-grow">
        <form method="GET" class="flex-grow max-w-md">
            <div class="relative">
                <input type="text"
                       name="search"
                       value="{{ $search }}"
                       placeholder="Search products..."
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <button type="submit" class="absolute right-2 top-2 text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </div>
        </form>

        <form method="GET" class="w-full sm:w-auto">
            <input type="hidden" name="search" value="{{ $search }}">
            <input type="hidden" name="sort" value="{{ $sortField }}">
            <input type="hidden" name="direction" value="{{ $sortDirection }}">
            <select name="status"
                    onchange="this.form.submit()"
                    class="w-full sm:w-auto px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="all" {{ $currentStatus === 'all' ? 'selected' : '' }}>All Status</option>
                <option value="available" {{ $currentStatus === 'available' ? 'selected' : '' }}>Available</option>
                <option value="unavailable" {{ $currentStatus === 'unavailable' ? 'selected' : '' }}>Unavailable</option>
            </select>
        </form>
    </div>

    <a href="{{ route('products.create') }}"
       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Add Product
    </a>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    @foreach(['Image', 'Article', 'Name', 'Status', 'Price', 'Size'] as $column)
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <a href="{{ request()->fullUrlWithQuery([
                                'sort' => strtolower($column),
                                'direction' => ($sortField === strtolower($column) && $sortDirection === 'asc') ? 'desc' : 'asc'
                            ]) }}" class="group inline-flex items-center">
                                {{ $column }}
                                @if($sortField === strtolower($column))
                                    <span class="ml-2">
                                        @if($sortDirection === 'asc')
                                            ↑
                                        @else
                                            ↓
                                        @endif
                                    </span>
                                @endif
                            </a>
                        </th>
                    @endforeach
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img src="https://placehold.co/100x100" alt="Product" class="h-20 w-20 rounded-lg object-cover">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->article }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $product->status === 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $product->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">${{ number_format($product->data['price'], 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->data['size'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <a href="{{ route('products.show', $product) }}"
                               class="text-blue-600 hover:text-blue-900 inline-flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                View
                            </a>
                            <a href="{{ route('products.edit', $product) }}"
                               class="text-indigo-600 hover:text-indigo-900 inline-flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>
                            <form id="delete-form-{{ $product->id }}"
                                  action="{{ route('products.destroy', $product) }}"
                                  method="POST"
                                  class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                        onclick="openModal('delete-modal-{{ $product->id }}')"
                                        class="text-red-600 hover:text-red-900 inline-flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Delete
                                </button>
                            </form>

                            <!-- Модальное окно для текущего продукта -->
                            <div id="delete-modal-{{ $product->id }}"
                                 class="modal hidden fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
                                <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

                                <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                                    <div class="modal-content py-4 text-left px-6">
                                        <div class="flex justify-between items-center pb-3">
                                            <p class="text-2xl font-bold">Confirm Delete</p>
                                            <button onclick="closeModal('delete-modal-{{ $product->id }}')" class="modal-close">
                                                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"/>
                                                </svg>
                                            </button>
                                        </div>

                                        <p class="mb-5">Are you sure you want to delete this product?</p>

                                        <div class="flex justify-end pt-2">
                                            <button onclick="closeModal('delete-modal-{{ $product->id }}')"
                                                    class="px-4 bg-transparent p-3 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700 mr-2">
                                                Cancel
                                            </button>
                                            <button onclick="document.getElementById('delete-form-{{ $product->id }}').submit()"
                                                    class="px-4 bg-red-500 p-3 rounded-lg text-white hover:bg-red-400">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex justify-center px-6 py-4 border-t border-gray-200">
        {{ $products->links() }}
    </div>
</div>
@endsection
