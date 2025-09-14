{{-- resources/views/admin/purchase_orders/index.blade.php --}}
<x-app-layout>
<div class="max-w-6xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Daftar Purchase Orders</h2>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($orders->isEmpty())
        <p class="text-gray-500">Belum ada PO.</p>
    @else
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">No</th>
                    <th class="border border-gray-300 px-4 py-2">Supplier</th>
                    <th class="border border-gray-300 px-4 py-2">Tanggal Order</th>
                    <th class="border border-gray-300 px-4 py-2">Dibuat oleh</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                    <th class="border border-gray-300 px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $index => $order)
                    <tr>
                        <td class="border px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border px-4 py-2">{{ $order->supplier->name ?? '-' }}</td>
                        <td class="border px-4 py-2">{{ $order->order_date ?? '-' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $order->creator->name}}</td>
                        <td class="border px-4 py-2">
                            <form action="{{ route('purchase_orders.updateStatus', $order->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" 
                                        onchange="this.form.submit()" 
                                        class="rounded border-gray-300 text-sm px-2 py-1">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="received" {{ $order->status == 'received' ? 'selected' : '' }}>Received</option>
                                    <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    @endif
</div>
</x-app-layout>
