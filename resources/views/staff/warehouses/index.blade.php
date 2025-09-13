@section('title', 'Warehouse')

<x-app-layout>
    <x-slot name="header">
        List WareHouses
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    
            {{-- Search Form --}}
            <div class="m-6 justify-center items-center">
                <form method="GET" action="{{ route('staff.warehouses.index') }}" class="flex items-center space-x-2">
                    <input type="text" 
                           name="search" 
                           value="{{ $search }}"
                           placeholder="Search warehouse..." 
                           class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-200 focus:outline-none" />
                    <button type="submit" 
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Search
                    </button>
                </form>
            </div>

            {{-- Product Table --}}
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Location</th>
                            <th class="px-6 py-3">Created_at</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($warehouses as $warehouse)
                            <tr>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $warehouse->name }}</td>
                                <td class="px-6 py-4">{{ $warehouse->location ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $warehouse->created_at->format('d F Y') }}</td>
                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    No warehouse found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $warehouses->appends(['search' => $search])->links() }}
            </div>

        </div>
    </div>
</x-app-layout>