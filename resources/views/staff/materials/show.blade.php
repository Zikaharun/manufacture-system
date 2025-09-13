@section('title', 'Materials')

<x-app-layout>
    <x-slot name="header">
        Detail Materials
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

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
                            <th class="px-2 py-2 sm:px-6 sm:py-3 text-right">Created_at</th>
                            <th class="px-2 py-2 sm:px-6 sm:py-3 text-right">Updated_at</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @if (!$material !== null)
                            <tr class="text-[11px] sm:text-sm"> <!-- kecil di mobile -->
                                <td class="px-2 py-2 sm:px-6 sm:py-4 font-medium text-gray-900">
                                    {{ $material->name }}
                                </td>
                                <td class="px-2 py-2 sm:px-6 sm:py-4">{{ $material->unit ?? '-' }}</td>
                                <td class="px-2 py-2 sm:px-6 sm:py-4">Rp {{ number_format($material->cost_price, 2, ',', '.') }}</td>
                                <td class="px-2 py-2 sm:px-6 sm:py-4">{{ intval($material->stock) ?? '-'}}</td>
                                <td class="px-2 py-2 sm:px-6 sm:py-4">{{ intval($material->minimum_stock) ?? '-'}}</td>
                                <td class="px-6 py-4">{{ $material->created_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $material->updated_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') ?? '-' }}</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500 text-xs sm:text-sm">
                                    No materials found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>