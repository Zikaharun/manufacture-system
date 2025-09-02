@section('title', 'Materials')

<x-app-layout>
    <x-slot name="header">
        List Materials
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
                <a href="{{ route('materials.create') }}"
                   class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Add Material
                </a>
            </div>

            {{-- Search Form --}}
            <div class="m-6 justify-center items-center">
                <form method="GET" action="{{ route('materials.index') }}" class="flex items-center space-x-2">
                    <input type="text" 
                           name="search" 
                           value="{{ $search }}"
                           placeholder="Search materials..." 
                           class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-200 focus:outline-none" />
                    <button type="submit" 
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Search
                    </button>
                </form>
            </div>

            {{-- Material Table --}}
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Unit</th>
                            <th class="px-6 py-3">Price</th>
                            <th class="px-6 py-3">Stock</th>
                            <th class="px-6 py-3">Minimum Stock</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($materials as $material)
                            <tr>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $material->name }}</td>
                                <td class="px-6 py-4">{{ $material->unit ?? '-' }}</td>
                                <td class="px-6 py-4">Rp {{ number_format($material->cost_price, 2, ',', '.') }}</td>
                                <td class="px-6 py-4">{{ intval($material->stock) ?? '-'}}</td>
                                <td class="px-6 py-4">{{ intval($material->minimum_stock) ?? '-'}}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('materials.edit', $material->id) }}" 
                                       class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 mb-4">
                                        Edit
                                    </a>
                                    <form action="{{ route('materials.destroy', $material->id) }}" method="POST" class="inline">
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
                                    No materials found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $materials->appends(['search' => $search])->links() }}
            </div>

        </div>
    </div>
</x-app-layout>