<x-app-layout>
            <div class="max-w-4xl mx-auto p-6">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">
                    Stock Movement Detail
                </h1>

                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-gray-700 dark:text-gray-300">
                    <div>
                        <dt class="font-medium">Material</dt>
                        <dd>{{ $movement->material->name ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium">Warehouse</dt>
                        <dd>{{ $movement->warehouse->name ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium">Type</dt>
                        <dd>
                            <span class="px-2 py-1 rounded-full text-xs font-medium 
                                {{ $movement->type == 'in' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                {{ strtoupper($movement->type) }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="font-medium">Quantity</dt>
                        <dd>{{ $movement->quantity }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium">Reference</dt>
                        <dd>{{ $movement->reference ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium">Created By</dt>
                        <dd>{{ $movement->creator->name ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium">Date</dt>
                        <dd>{{ $movement->created_at->setTimezone('Asia/Jakarta')->translatedFormat('d F Y H:i') }}</dd>
                    </div>
                </dl>

                <div class="mt-6">
                    <a href="{{ route('stock_movements.index') }}" 
                    class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md shadow">
                        Back
                    </a>
                </div>
            </div>
        </div>
</x-app-layout>