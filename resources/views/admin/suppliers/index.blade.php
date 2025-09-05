@section('title', 'Suppliers')

<x-app-layout>
    <x-slot name="header">
        List Suppliers
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="mb-6 px-4 py-3 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 px-4 py-3 bg-red-100 text-red-800 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Add Product Button --}}
            <div class="m-6 flex justify-end">
                <a href="{{ route('suppliers.create') }}"
                   class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Add Supplier
                </a>
            </div>

            {{-- Search Form --}}
            <div class="m-6 justify-center items-center">
                <form method="GET" action="{{ route('products.index') }}" class="flex items-center space-x-2">
                    <input type="text" 
                           name="search" 
                           value="{{ $search }}"
                           placeholder="Search products..." 
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
                            <th class="px-6 py-3 text-right">Actions</th>
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
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('suppliers.edit', $supplier->id) }}" 
                                       class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 mb-4">
                                        Edit
                                    </a>
                                    <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Are you sure?')" 
                                                class="px-3 py-1 bg-red-500 text-white rounded-md mt-2 hover:bg-red-600">
                                            Delete
                                        </button>
                                    </form>
                                </td>
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