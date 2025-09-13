@section('title', 'Purchase Orders')

<x-app-layout>
<div class="container mx-auto px-6 py-8">
    <h1 class="text-2xl font-bold mb-6">Purchase Orders</h1>

    @if($orders->isEmpty())
        <div class="bg-yellow-100 text-yellow-700 p-4 rounded-lg">
            Belum ada PO.
        </div>
    @else
        <table class="w-full border-collapse bg-white shadow-lg rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                    <th class="p-3">Total Bahan Baku</th>
                    <th class="p-3">Supplier</th>
                    <th class="p-3">Tanggal</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3 text-sm">{{ $order->items_count }}</td>
                    <td class="p-3 text-sm">{{ $order->supplier->name ?? '-' }}</td>
                    <td class="p-3 text-sm">{{ $order->order_date }}</td>
                    <td class="p-3">
                        <span class="px-3 py-1 rounded-full text-xs 
                            @if($order->status == 'pending') bg-yellow-200 text-yellow-800
                            @elseif($order->status == 'received') bg-green-200 text-green-800
                            @else bg-red-200 text-red-800 @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="p-3 flex gap-2 flex-wrap">

                        <!-- Tombol Edit & Show -->
                        <a href="{{ route('staff.purchase_orders.edit', $order->id) }}" 
                           class="px-3 py-1 text-sm bg-blue-500 text-white rounded hover:bg-blue-600">
                           Edit
                        </a>
                        <a href="{{ route('staff.purchase_orders.show', $order->id)}}" 
                           class="px-3 py-1 text-sm bg-gray-500 text-white rounded hover:bg-gray-600">
                           Lihat
                        </a>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('staff.purchase_orders.destroy', $order->id) }}" method="POST" 
                              onsubmit="return confirm('Yakin hapus PO ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600">
                                Hapus
                            </button>
                        </form>

                        <!-- Tombol Mark as Received dengan Modal Warehouse -->
                        @if($order->status === 'pending')
                        <div x-data="{ open: false }">
                            <button @click="open = true" 
                                    class="px-3 py-1 text-sm bg-green-500 text-white rounded hover:bg-green-600">
                                Mark as Received
                            </button>

                            <!-- Modal -->
                            <div x-show="open" 
                                 class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                <div @click.away="open = false" 
                                     class="bg-white p-6 rounded-lg w-96 shadow-lg">
                                    <h2 class="text-lg font-semibold mb-4">Pilih Warehouse</h2>

                                    <form action="{{ route('staff.purchase_orders.markAsReceived', $order->id) }}" method="POST">
                                        @csrf
                                        <div class="mb-4">
                                            <label class="block mb-1 font-medium">Warehouse</label>
                                            <select name="warehouse_id" required
                                                    class="w-full border-gray-300 rounded-lg shadow-sm">
                                                <option value="" disabled selected>Pilih Warehouse</option>
                                                @foreach($warehouses as $warehouse)
                                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="flex justify-end gap-2">
                                            <button type="button" @click="open = false" 
                                                    class="px-3 py-1 bg-gray-300 rounded">
                                                Batal
                                            </button>
                                            <button type="submit" 
                                                    class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                                Tandai Diterima
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @elseif($order->status === 'received')
                            <form action="{{ route('staff.purchase_orders.unreceive', $order->id) }}" method="POST" 
                                  onsubmit="return confirm('Batalkan status received & rollback stok?');">
                                @csrf
                                <button type="submit" class="px-3 py-1 text-sm bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                    Batalkan Received
                                </button>
                            </form>
                        @endif

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="mt-6">
        <a href="{{ route('staff.purchase_orders.create') }}" 
           class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
           + Buat Purchase Order
        </a>
    </div>
</div>

<!-- Alpine.js CDN -->

</x-app-layout>

