<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Welcome card --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                        Welcome, {{ auth()->user()->name }}
                    </h3>
                    <p class="mt-1 text-gray-600 dark:text-gray-400">
                        Here’s a quick overview of your system.
                    </p>
                </div>
                {{-- Avatar with initial --}}
                <div class="w-16 h-16 rounded-full bg-blue-500 flex items-center justify-center text-white text-2xl font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>


            {{-- Summary cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Products --}}
                <a href="{{ route('products.index') }}" class="block bg-white dark:bg-gray-800 shadow-sm rounded-lg p-5 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Products</h4>
                            <p class="text-2xl font-semibold text-gray-800 dark:text-gray-200">{{ \App\Models\Product::count() }}</p>
                        </div>
                        <div class="text-gray-400 dark:text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/>
                            </svg>
                        </div>
                    </div>
                </a>

                {{-- Materials --}}
                <a href="{{ route('materials.index') }}" class="block bg-white dark:bg-gray-800 shadow-sm rounded-lg p-5 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Materials</h4>
                            <p class="text-2xl font-semibold text-gray-800 dark:text-gray-200">{{ \App\Models\Material::count() }}</p>
                        </div>
                        <div class="text-gray-400 dark:text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-3 0-6 2-6 6a6 6 0 0012 0c0-4-3-6-6-6z"/>
                            </svg>
                        </div>
                    </div>
                </a>

                {{-- Work Orders --}}
                <a href="{{ route('work_orders.index') }}" class="block bg-white dark:bg-gray-800 shadow-sm rounded-lg p-5 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Work Orders</h4>
                            <p class="text-2xl font-semibold text-gray-800 dark:text-gray-200">{{ \App\Models\WorkOrder::count() }}</p>
                        </div>
                        <div class="text-gray-400 dark:text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h6v6M3 3h18v18H3V3z"/>
                            </svg>
                        </div>
                    </div>
                </a>

                {{-- Stock Movements --}}
                <a href="{{ route('stock_movements.index') }}" class="block bg-white dark:bg-gray-800 shadow-sm rounded-lg p-5 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Stock Movements</h4>
                            <p class="text-2xl font-semibold text-gray-800 dark:text-gray-200">{{ \App\Models\StockMoveMent::count() }}</p>
                        </div>
                        <div class="text-gray-400 dark:text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Quick Actions --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 space-y-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Quick Actions</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="{{ route('products.create') }}" class="block bg-blue-500 hover:bg-blue-600 text-white text-center py-3 rounded-lg transition">Add Product</a>
                    <a href="{{ route('materials.create') }}" class="block bg-green-500 hover:bg-green-600 text-white text-center py-3 rounded-lg transition">Add Material</a>
                    <a href="{{ route('work_orders.create') }}" class="block bg-yellow-500 hover:bg-yellow-600 text-white text-center py-3 rounded-lg transition">New Work Order</a>
                    <a href="{{ route('boms.create') }}" class="block bg-purple-500 hover:bg-purple-600 text-white text-center py-3 rounded-lg transition">Create BOM</a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>