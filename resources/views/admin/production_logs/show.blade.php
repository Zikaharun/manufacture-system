
@section('title', 'Detail Production Logs')

<x-app-layout>
    <div class="p-6">
    <h1 class="text-xl font-bold mb-4">Detail Production Log</h1>

    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 space-y-4">
        <div class="text-white">
            <strong>Work Order:</strong> {{ $log->workOrder->wo_code ?? '-' }}
        </div>
        <div class="text-white">
            <strong>Produced:</strong> {{ $log->quantity_produced }}
        </div>
        <div class="text-white">
            <strong>Rejects:</strong> {{ $log->reject_quantity }}
        </div>
        <div class="text-white">
            <strong>User:</strong> {{ $log->user->name ?? '-' }}
        </div>
        <div class="text-white">
            <strong>Production Date:</strong> {{ \Carbon\Carbon::parse($log->production_date)->format('d M Y') }}
        </div>
        <div class="text-white">
            <strong>Created At:</strong> {{ $log->created_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') }}
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('production_logs.index') }}" class="text-blue-600 hover:text-blue-800">← Back to list</a>
    </div>
</div>
</x-app-layout>