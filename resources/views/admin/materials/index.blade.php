@section('title', 'Materials')

<x-app-layout>
    <x-slot name="header">
        List Materials
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="mb-6 px-4 py-3 bg-green-100 text-green-800 rounded-lg text-sm sm:text-base">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 px-4 py-3 bg-red-100 text-red-800 rounded-lg text-sm sm:text-base">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Add Product Button --}}
            <div class="m-6 flex justify-end">
                <a href="{{ route('materials.create') }}"
                   class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 text-sm sm:text-base">
                    Add Material
                </a>
            </div>

            {{-- Search Form --}}
            <div class="m-6 flex justify-center items-center">
                <form method="GET" action="{{ route('materials.index') }}" 
                      class="flex flex-col sm:flex-row items-center w-full gap-2">
                    <input type="text" 
                           name="search" 
                           value="{{ $search }}"
                           placeholder="Search materials..." 
                           class="w-full sm:w-72 px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-200 focus:outline-none text-sm sm:text-base" />
                    <button type="submit" 
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 w-full sm:w-auto text-sm sm:text-base">
                        Search
                    </button>
                </form>
            </div>

            {{-- Material Table --}}
           <div class="bg-white shadow-sm sm:rounded-lg overflow-x-auto">
                <table class="min-w-full text-xs sm:text-sm text-left"> <!-- text-xs di mobile -->
                    <thead class="bg-gray-100 text-gray-700 text-[10px] sm:text-xs">
                        <tr>
                            <th class="px-2 py-2 sm:px-6 sm:py-3">Name</th>
                            <th class="px-2 py-2 sm:px-6 sm:py-3">Unit</th>
                            <th class="px-2 py-2 sm:px-6 sm:py-3">Price</th>
                            <th class="px-2 py-2 sm:px-6 sm:py-3">Stock</th>
                            <th class="px-2 py-2 sm:px-6 sm:py-3">Minimum Stock</th>
                            <th class="px-2 py-2 sm:px-6 sm:py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($materials as $material)
                            <tr class="text-[11px] sm:text-sm"> <!-- kecil di mobile -->
                                <td class="px-2 py-2 sm:px-6 sm:py-4 font-medium text-gray-900">
                                    {{ $material->name }}
                                </td>
                                <td class="px-2 py-2 sm:px-6 sm:py-4">{{ $material->unit ?? '-' }}</td>
                                <td class="px-2 py-2 sm:px-6 sm:py-4">Rp {{ number_format($material->cost_price, 2, ',', '.') }}</td>
                                <td class="px-2 py-2 sm:px-6 sm:py-4">{{ intval($material->stock) ?? '-'}}</td>
                                <td class="px-2 py-2 sm:px-6 sm:py-4">{{ intval($material->minimum_stock) ?? '-'}}</td>
                                <td class="px-2 py-2 sm:px-6 sm:py-4 text-right flex flex-col sm:flex-row sm:space-x-2 items-end space-y-2 sm:space-y-0">
                                    <a href="{{ route('materials.edit', $material->id) }}" 
                                    class="px-2 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 text-[10px] sm:text-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('materials.destroy', $material->id) }}" method="POST" class="inline w-full sm:w-auto">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Are you sure?')" 
                                                class="px-2 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 text-[10px] sm:text-sm w-full sm:w-auto">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500 text-xs sm:text-sm">
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
