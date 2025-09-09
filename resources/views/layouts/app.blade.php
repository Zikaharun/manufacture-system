<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

       <title>@yield('title', config('app.name', 'Laravel'))</title>


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 flex flex-col">
        {{-- Navigation bar --}}
        @include('layouts.navigation')

        {{-- Page Heading --}}
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <div class="flex flex-1">
            {{-- Sidebar untuk desktop --}}
            <aside class="hidden md:block bg-white">
                @include('layouts.sidebar')
            </aside>

            {{-- Main Content --}}
            <main class="flex-1 p-6 relative">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Overlay -->
    <div id="overlay" 
        class="fixed inset-0 bg-black bg-opacity-50 hidden z-40 md:hidden"
        onclick="toggleSidebar()"></div>

    {{-- Sidebar overlay (hanya tampil di mobile) --}}
    <div id="sidebar"
         class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out z-50 md:hidden">
        <div class="p-4 border-b font-bold">Manufacture-System</div>
        <ul class="p-4 space-y-2">
            @if (Auth::user()->role === 'admin')
            <li><a href="{{ route('admin.dashboard')}}" class="block p-2 rounded hover:bg-gray-100">Dashboard</a></li>
            <li><a href="{{ route('warehouses.index')}}" class="block p-2 rounded hover:bg-gray-100">Warehouses</a></li>
            <li><a href="{{ route('suppliers.index')}}" class="block p-2 rounded hover:bg-gray-100">Suppliers</a></li>
            <li><a href="{{ route('purchase_orders.index')}}" class="block p-2 rounded hover:bg-gray-100">Tracking PO</a></li>
            <li><a href="{{ route('stock_movements.index')}}" class="block p-2 rounded hover:bg-gray-100">Stock Movements</a></li>
            <li><a href="{{ route('material_usages.index')}}" class="block p-2 rounded hover:bg-gray-100">Material Usages</a></li>
            <li><a href="{{ route('production_logs.index')}}" class="block p-2 rounded hover:bg-gray-100">Production Logs</a></li>
            @else
            <li><a href="{{ route('staff.dashboard')}}" class="block p-2 rounded hover:bg-gray-100">Dashboard</a></li>
            @endif
        </ul>
    </div>

    {{-- Toggle button (hanya tampil di mobile) --}}
    <button onclick="toggleSidebar()"
            class="fixed top-4 left-4 z-50 bg-blue-600 text-white px-3 py-2 rounded-md shadow md:hidden">
        ☰
    </button>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            const isHidden = sidebar.classList.contains('-translate-x-full');

            if (isHidden) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }

    </script>
    </body>



</html>
