@section('title', 'Detail Purchase Order')

<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-2xl font-bold mb-6">Detail Purchase Order</h1>

        {{-- Info utama Purchase Order --}}
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4">Informasi Order</h2>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Supplier</p>
                    <p class="font-medium">{{ $order->supplier->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal Order</p>
                    <p class="font-medium">{{ $order->order_date }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Pembuat PO</p>
                    <p class="font-medium">{{ $order->creator->name }}</p>
                </div>
            </div>
        </div>

        {{-- Daftar Items --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-4">Daftar Items</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Material</th>
                        <th class="px-4 py-2 text-right text-sm font-medium text-gray-600">Quantity</th>
                        <th class="px-4 py-2 text-right text-sm font-medium text-gray-600">Unit</th>
                        <th class="px-4 py-2 text-right text-sm font-medium text-gray-600">Unit Price</th>
                        <th class="px-4 py-2 text-right text-sm font-medium text-gray-600">Total Price</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($order->items as $item)
                        <tr>
                            <td class="px-4 py-2">{{ $item->material->name }}</td>
                            <td class="px-4 py-2 text-right">{{ number_format($item->quantity, 2) }}</td>
                            <td class="px-4 py-2 text-right">{{ $item->unit }}</td>
                            <td class="px-4 py-2 text-right">Rp {{ number_format($item->unit_price, 2) }}</td>
                            <td class="px-4 py-2 text-right">Rp {{ number_format($item->total_price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="3" class="px-4 py-2 text-right font-semibold">Grand Total</td>
                        <td class="px-4 py-2 text-right font-bold text-indigo-600">
                            Rp {{ number_format($order->items->sum('total_price'), 2) }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="mt-6">
            <a href="{{ route('staff.purchase_orders.index') }}" 
               class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300">
                Kembali
            </a>
        </div>
    </div>
</x-app-layout>
