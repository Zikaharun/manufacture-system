@section('title', 'Detail Products')

<x-app-layout>
    <x-slot name="header">
        Detail Products
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">



            {{-- Product Table --}}
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">SKU</th>
                            <th class="px-6 py-3">Unit</th>
                            <th class="px-6 py-3">Price</th>
                            <th class="px-6 py-3">Created_at</th>
                            <th class="px-6 py-3">Updated_at</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @if ($product !== null)
                            <tr>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $product->name ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $product->sku ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $product->unit ?? '-' }}</td>
                                <td class="px-6 py-4">Rp {{ number_format($product->price, 2, ',', '.') ?? '-'}}</td>
                                <td class="px-6 py-4">{{ $product->created_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $product->updated_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') ?? '-' }}</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    No products found.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>