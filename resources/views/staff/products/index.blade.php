@section('title', 'Products')

<x-app-layout>
    <x-slot name="header">
        List Products
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">



            {{-- Search Form --}}
            <div class="m-6 justify-center items-center">
                <form method="GET" action="{{ route('staff.products.index') }}" class="flex items-center space-x-2">
                    <input type="text" 
                           name="search" 
                           value="{{ $search }}"
                           placeholder="Search products..." 
                           class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-200 focus:outline-none" />
                    <button type="submit" 
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Search
                    </button>
                </form>
            </div>

            {{-- Product Table --}}
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">SKU</th>
                            <th class="px-6 py-3">Unit</th>
                            <th class="px-6 py-3">Price</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($products as $product)
                            <tr>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $product->name }}</td>
                                <td class="px-6 py-4">{{ $product->sku ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $product->unit }}</td>
                                <td class="px-6 py-4">Rp {{ number_format($product->price, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('staff.products.show', $product->id) }}" 
                                       class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 mb-4">
                                        Detail Products
                                    </a>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    No products found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $products->appends(['search' => $search])->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
