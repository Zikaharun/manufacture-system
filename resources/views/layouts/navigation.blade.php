<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                @if (Auth::user()->role->name === 'admin')
                   
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center mb-4 mt-5 space-x-3">
                        <!-- Icon huruf awal dengan warna cerah -->
                        <span class="bg-blue-500 mb-2 text-white rounded-full w-10 h-10 flex items-center justify-center font-bold text-lg">
                            M
                        </span>
                        <!-- Teks logo -->
                        <span class="font-bold text-blue-600 text-xl">
                            Manufacture.Sys
                        </span>
                    </a>

                    @else
                    <a href="{{ route('staff.dashboard') }}" class="flex items-center mb-4 mt-5 space-x-3">
                        <!-- Icon huruf awal dengan warna cerah -->
                        <span class="bg-blue-500 text-white rounded-full w-10 mb-2 h-10 flex items-center justify-center font-bold text-lg">
                            M
                        </span>
                        <!-- Teks logo -->
                        <span class="font-bold text-blue-600 text-xl">
                            Manufacture.Sys
                        </span>
                    </a>


                @endif

                <!-- Navigation Links -->
                @if (Auth::user()->role->name === 'admin')

                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                                {{ __('Products') }}
                            </x-nav-link>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('materials.index')" :active="request()->routeIs('materials.index')">
                                {{ __('Materials') }}
                            </x-nav-link>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('boms.index')" :active="request()->routeIs('boms.index')">
                                {{ __('Bill of Materials') }}
                            </x-nav-link>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('work_orders.index')" :active="request()->routeIs('work_orders.index')">
                                {{ __('Work Orders') }}
                            </x-nav-link>
                        </div>
                @else
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('staff.products.index')" :active="request()->routeIs('staff.products.index')">
                                {{ __('Products') }}
                            </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('staff.materials.index')" :active="request()->routeIs('staff.materials.index')">
                                {{ __('Materials') }}
                            </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('staff.boms.index')" :active="request()->routeIs('staff.boms.index')">
                                {{ __('Bill Of Materials') }}
                            </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('staff.suppliers.index')" :active="request()->routeIs('staff.suppliers.index')">
                                {{ __('Suppliers') }}
                            </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('staff.warehouses.index')" :active="request()->routeIs('staff.warehouses.index')">
                                {{ __('Warehouses') }}
                            </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('staff.work_orders.index')" :active="request()->routeIs('staff.work_orders.index')">
                                {{ __('Work Orders') }}
                            </x-nav-link>
                        </div>
                @endif

            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        @if (Auth::user()->role->name === 'admin')
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('dashboard.index')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                {{ __('Products') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('materials.index')" :active="request()->routeIs('materials.index')">
                {{ __('Materials') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('boms.index')" :active="request()->routeIs('boms.index')">
                {{ __('BOM') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('work_orders.index')" :active="request()->routeIs('Work_orders.index')">
                {{ __('Work Orders') }}
            </x-responsive-nav-link>
        </div>

        @else
         <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('staff.dashboard')" :active="request()->routeIs('staff.dashboard.index')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('staff.products.index')" :active="request()->routeIs('staff.products.index')">
                {{ __('Products') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('staff.materials.index')" :active="request()->routeIs('staff.materials.index')">
                {{ __('Materials') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('staff.boms.index')" :active="request()->routeIs('staff.boms.index')">
                {{ __('Bill Of Materials') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('staff.suppliers.index')" :active="request()->routeIs('staff.suppliers.index')">
                {{ __('Suppliers') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('staff.warehouses.index')" :active="request()->routeIs('staff.warehouses.index')">
                {{ __('Warehouses') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('staff.work_orders.index')" :active="request()->routeIs('staff.work_orders.index')">
                {{ __('Work Orders') }}
            </x-responsive-nav-link>
        </div>
        @endif
        
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
