@section('title', 'Bill of Materials')

<x-app-layout>
    <div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Bill of Materials</h1>

        <!-- Tabel Data BOM -->
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-gray-900 uppercase text-xs font-semibold hidden md:table-header-group">
                    <tr>
                        <th class="px-6 py-3">#</th>
                        {{-- <th class="px-6 py-3">Kode BOM</th> --}}
                        <th class="px-6 py-3">Nama Produk</th>
                        <th class="px-6 py-3">Jumlah Material</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($boms as $index => $item)
                        <tr class="border-b hover:bg-gray-50 flex flex-col md:table-row md:flex-row w-full md:w-auto">
                            <td class="px-6 py-4 md:table-cell font-semibold md:font-normal">
                                <span class="md:hidden font-bold">#</span>
                                {{ $index + 1 }}
                            </td>
                            {{-- <td class="px-6 py-4 font-medium text-gray-900">{{ $item->kode_bom }}</td> --}}
                            <td class="px-6 py-4 md:table-cell">
                                <span class="md:hidden font-bold">Nama Produk: </span>
                                {{ $item?->product?->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4 md:table-cell">
                                <span class="md:hidden font-bold">Jumlah Material: </span>
                                {{ $item->total_materials }}
                            </td>
                            <td class="px-6 py-4 text-center space-x-2 md:table-cell flex flex-row md:flex-row justify-center items-center">
                                <a href="{{ route('staff.boms.show', $item->product_id) }}" 
                                   class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 mb-2 md:mb-0">
                                    Lihat
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data Bill of Materials
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>