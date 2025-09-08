@section('title', 'Stock Movements Monitoring')

<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6 text-black">Stock Movements Monitoring</h1>

        <!-- Filter Form -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4 mb-6">
            <h2 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-300">Filter Logs</h2>
            <form method="GET" action="{{ route('stock_movements.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                
                <!-- Date From -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">From</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}"
                        class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm">
                </div>

                <!-- Date To -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">To</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}"
                        class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm">
                </div>

                <!-- Material -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Material</label>
                    <select name="material_id"
                        class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm">
                        <option value="">-- All --</option>
                        @foreach($materials as $mat)
                            <option value="{{ $mat->id }}" @selected(request('material_id') == $mat->id)>{{ $mat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type</label>
                    <select name="type"
                        class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm">
                        <option value="">-- All --</option>
                        <option value="in" @selected(request('type')=='in')>IN</option>
                        <option value="out" @selected(request('type')=='out')>OUT</option>
                    </select>
                </div>

                <div class="md:col-span-4 flex gap-2 mt-2">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Filter</button>
                    <a href="{{ route('stock_movements.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md">Reset</a>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-300">
                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-6 py-3">#</th>
                        <th class="px-6 py-3">Material</th>
                        <th class="px-6 py-3">Warehouse</th>
                        <th class="px-6 py-3">Type</th>
                        <th class="px-6 py-3">Quantity</th>
                        <th class="px-6 py-3">Reference</th>
                        <th class="px-6 py-3">Created By</th>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($movements as $index => $movement)
                        <tr class="border-b dark:border-gray-700">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $movement->material->name ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $movement->warehouse->name ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-medium {{ $movement->type === 'in' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                    {{ strtoupper($movement->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $movement->quantity }}</td>
                            <td class="px-6 py-4">{{ $movement->reference ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $movement->creator->name ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $movement->created_at->format('d-m-Y H:i') }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('stock_movements.show', $movement->id) }}" class="text-blue-600 hover:text-blue-800">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-6 text-center text-gray-500 dark:text-gray-400 italic">
                                No stock movement activity yet
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $movements->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
