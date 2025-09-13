@section('title', 'Material Usages')

<x-app-layout>
    <div class="p-6">
    <h1 class="text-xl font-bold mb-4">Detail Material Usage</h1>

    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 space-y-4">
        <div>
            <strong>Work Order:</strong> {{ $usage->workOrder?->product?->name ?? '-' }}
        </div>
        <div>
            <strong>Work Order Quantity Target:</strong> {{ $usage->workOrder->quantity ?? '-' }}
        </div>
        <div>
            <strong>Material:</strong> {{ $usage->material->name ?? '-' }}
        </div>
        <div>
            <strong>Quantity:</strong> {{ intval($usage->quantity) }}
        </div>
        <div>
            <strong>Used By:</strong> {{ $usage->user->name ?? '-' }}
        </div>
        <div>
            <strong>Date:</strong> {{ $usage->created_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') }}
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('material_usages.index') }}" class="text-blue-600 hover:text-blue-800">← Back to list</a>
    </div>
</div>
</x-app-layout>