@section('title', 'Production Logs')

<x-app-layout>
    <div class="p-6">
    <h1 class="text-xl font-bold mb-4">Monitoring Production Logs</h1>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-lg">
        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-300">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-6 py-3">#</th>
                    <th class="px-6 py-3">Work Order</th>
                    <th class="px-6 py-3">Produced</th>
                    <th class="px-6 py-3">Rejects</th>
                    <th class="px-6 py-3">User</th>
                    <th class="px-6 py-3">Production Date</th>
                    <th class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $index => $log)
                    <tr class="border-b dark:border-gray-700">
                        <td class="px-6 py-4">{{ $index + $logs->firstItem() }}</td>
                        <td class="px-6 py-4">{{ $log->workOrder->code ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $log->quantity_produced }}</td>
                        <td class="px-6 py-4">{{ $log->reject_quantity }}</td>
                        <td class="px-6 py-4">{{ $log->user->name ?? '-' }}</td>
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($log->production_date)->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('production_logs.show', $log->id) }}" class="text-blue-600 hover:text-blue-800">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            Belum ada aktivitas produksi
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $logs->links() }}
    </div>
</div>
</x-app-layout>