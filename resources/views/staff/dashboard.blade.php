<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Staff Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Welcome card --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                        Welcome, {{ auth()->user()->name }}
                    </h3>
                    <p class="mt-1 text-gray-600 dark:text-gray-400">
                        Here's a quick overview of your activities.
                    </p>
                </div>
                {{-- Avatar initial --}}
                <div class="w-16 h-16 rounded-full bg-indigo-500 flex items-center justify-center text-white text-2xl font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>

            {{-- Quick stats cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Products --}}
                <a href="{{ route('staff.products.index') }}" class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-5 hover:shadow-md transition flex flex-col">
                    <span class="text-gray-500 dark:text-gray-400 text-sm">Products</span>
                    <span class="mt-2 text-2xl font-bold text-gray-800 dark:text-gray-100">{{ \App\Models\Product::count() }}</span>
                </a>

                {{-- Materials --}}
                <a href="{{ route('staff.materials.index') }}" class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-5 hover:shadow-md transition flex flex-col">
                    <span class="text-gray-500 dark:text-gray-400 text-sm">Materials</span>
                    <span class="mt-2 text-2xl font-bold text-gray-800 dark:text-gray-100">{{ \App\Models\Material::count() }}</span>
                </a>

                {{-- Work Orders --}}
                <a href="{{ route('staff.work_orders.index') }}" class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-5 hover:shadow-md transition flex flex-col">
                    <span class="text-gray-500 dark:text-gray-400 text-sm">Work Orders</span>
                    <span class="mt-2 text-2xl font-bold text-gray-800 dark:text-gray-100">{{ \App\Models\WorkOrder::count() }}</span>
                </a>

                {{-- Purchase Orders --}}
                <a href="{{ route('staff.purchase_orders.index') }}" class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-5 hover:shadow-md transition flex flex-col">
                    <span class="text-gray-500 dark:text-gray-400 text-sm">Purchase Orders</span>
                    <span class="mt-2 text-2xl font-bold text-gray-800 dark:text-gray-100">{{ \App\Models\PurchaseOrder::count() }}</span>
                </a>
            </div>

            {{-- Recent Activities (optional) --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Recent Work Orders</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm text-gray-700 dark:text-gray-300">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-xs font-semibold">
                            <tr>
                                <th class="px-4 py-2">#</th>
                                <th class="px-4 py-2">WO Code</th>
                                <th class="px-4 py-2">Product</th>
                                <th class="px-4 py-2">Quantity</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\WorkOrder::latest()->take(5)->get() as $wo)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">{{ $wo->wo_code }}</td>
                                    <td class="px-4 py-2">{{ $wo->product->name ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $wo->quantity }}</td>
                                    <td class="px-4 py-2">
                                        <span class="px-2 py-1 rounded-full text-xs font-medium
                                            {{ $wo->status === 'planned' ? 'bg-gray-200 text-gray-800' : '' }}
                                            {{ $wo->status === 'in_progress' ? 'bg-blue-200 text-blue-800' : '' }}
                                            {{ $wo->status === 'completed' ? 'bg-green-200 text-green-800' : '' }}
                                            {{ $wo->status === 'canceled' ? 'bg-red-200 text-red-800' : '' }}">
                                            {{ ucfirst($wo->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">{{ $wo->planned_start_date?->format('d M Y') ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
