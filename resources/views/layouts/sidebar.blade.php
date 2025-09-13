<div x-data="{ open: true }" class="flex">
    <!-- Sidebar -->
    <aside 
        :class="open ? 'w-64' : 'w-20'" 
        class=" border-r border-gray-200 min-h-screen transition-all duration-300 flex flex-col"
    >
        <!-- Header / Logo -->
        <div class="flex items-center justify-between p-4 border-b">
            <span x-show="open" class="font-bold text-lg">Manufacture System</span>
            <button 
                @click="open = !open" 
                class="p-2 rounded-md hover:bg-gray-100"
            >
                <!-- Icon -->
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                </svg>
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h12" />
                </svg>
            </button>
        </div>

        <!-- Menu -->
        <nav class="flex-1 p-4 space-y-2">
            @if (Auth::user()->role->name === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-gray-100">
                <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 2v6m-4 0h8" />
                </svg>
                <span x-show="open">Dashboard</span>
            </a>
            <a href="{{ route('suppliers.index') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-gray-100">
                <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 01-8 0" />
                </svg>
                <span x-show="open">Suppliers</span>
            </a>
            <a href="{{ route('warehouses.index') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-gray-100">
                <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2h-4M4 13v6a2 2 0 002 2h4" />
                </svg>
                <span x-show="open">Warehouse</span>
            </a>
            <a href="{{ route('purchase_orders.index') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-gray-100">
                <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M9 12h6m-6 4h6M9 8h6m2-6H7a2 2 0 00-2 2v16a2 2 0 002 2h10a2 2 0 002-2V4a2 2 0 00-2-2z" />
                </svg>
                <span x-show="open">Purchase Orders</span>
            </a>

            <a href="{{ route('stock_movements.index') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-gray-100" aria-label="Stock Movements">
                    <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <!-- panah kiri -->
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7L3 11l4 4"></path>
                        <!-- panah kanan -->
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 7l4 4-4 4"></path>
                        <!-- garis penghubung -->
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 11h18"></path>
                    </svg>
                    <span x-show="open">Stock Movements</span>
                </a>

                <a href="{{ route('material_usages.index') }}" 
                    class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-gray-100">
                        <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M20.5 7.5l-8.5-4.5-8.5 4.5m17 0v9l-8.5 4.5m8.5-13.5l-8.5 4.5m-8.5-4.5v9l8.5 4.5m-8.5-13.5l8.5 4.5" />
                        </svg>
                        <span x-show="open">Material Usages</span>
                </a>

                <a href="{{ route('production_logs.index') }}" 
                class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-gray-100">
                    <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M9 5h6m-3-2v2m-6 4h12M9 13h6m-6 4h6M5 7h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2z" />
                    </svg>
                    <span x-show="open">Production Logs</span>
                </a>
            @else
            <a href="{{ route('staff.dashboard') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-gray-100">
                <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 2v6m-4 0h8" />
                </svg>
                <span x-show="open">Dashboard</span>
            </a>
            <a href="{{ route('staff.purchase_orders.index') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-gray-100">
                <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M9 12h6m-6 4h6M9 8h6m2-6H7a2 2 0 00-2 2v16a2 2 0 002 2h10a2 2 0 002-2V4a2 2 0 00-2-2z" />
                </svg>
                <span x-show="open">purchase-orders</span>
            </a>
            @endif
            


            
        </nav>
    </aside>
</div>


