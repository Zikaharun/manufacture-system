@section('title', 'Suppliers')

<x-app-layout>
    <x-slot name="header">
        List Suppliers
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">



            {{-- Search Form --}}
            <div class="m-6 justify-center items-center">
                <form method="GET" action="{{ route('staff.suppliers.index') }}" class="flex items-center space-x-2">
                    <input type="text" 
                           name="search" 
                           value="{{ $search }}"
                           placeholder="Search suppliers..." 
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
                            <th class="px-6 py-3">Contact Person</th>
                            <th class="px-6 py-3">Phone</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3">Address</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($suppliers as $supplier)
                            <tr>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $supplier->name }}</td>
                                <td class="px-6 py-4">{{ $supplier->contact_person }}</td>
                                <td class="px-6 py-4">{{ $supplier->phone ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $supplier->email }}</td>
                                <td class="px-6 py-4">{{ $supplier->address }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    No Suppliers found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $suppliers->appends(['search' => $search])->links() }}
            </div>

        </div>
    </div>
</x-app-layout>