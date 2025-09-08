@section('title', 'Work Orders')


<x-app-layout>
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 flex justify-between items-center border-b">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Work Orders</h2>
            <a href="{{ route('work_orders.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                + Create Work Order
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-300">
                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-6 py-3">#</th>
                        <th class="px-6 py-3">Product</th>
                        <th class="px-6 py-3">Quantity</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Planned Start</th>
                        <th class="px-6 py-3">Planned End</th>
                        <th class="px-6 py-3">Created At</th>
                        <th class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($workOrders as $index => $order)
                        <tr>
                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">{{ $order->product->name ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $order->quantity }}</td>
                            <td class="px-6 py-4">
                                <span class="
                                    px-2 py-1 rounded-full text-xs font-medium 
                                    @if($order->status == 'planned') bg-gray-200 text-gray-700 
                                    @elseif($order->status == 'in_progress') bg-yellow-200 text-yellow-800
                                    @elseif($order->status == 'completed') bg-green-200 text-green-800
                                    @elseif($order->status == 'canceled') bg-red-200 text-red-800
                                    @endif
                                ">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $order->planned_start_date->format('Y-m-d') ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $order->planned_end_date?->format('Y-m-d') ?? '-' }}</td>
                            <td class="px-6 py-4">
                                {{ $order->created_at->setTimezone('Asia/Jakarta')->translatedFormat('d F Y H:i') }}
                            </td>

                            <td class="px-6 py-4 flex space-x-2">
                                <a href="{{ route('work_orders.edit', $order->id) }}" 
                                   class="text-yellow-600 hover:text-yellow-800">Edit</a>
                                <form action="{{ route('work_orders.destroy', $order->id) }}" 
                                      method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-800">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">No Work Orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-app-layout>
