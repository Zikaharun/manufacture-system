<x-app-layout>
    <div class="max-w-6xl mx-auto py-10">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Bill of Materials</h1>

        <!-- Button tambah BOM -->
        <div class="mb-6">
            <a href="{{ route('boms.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                + Tambah BOM
            </a>
        </div>

        <!-- Tabel Data BOM -->
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-gray-900 uppercase text-xs font-semibold">
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
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                            {{-- <td class="px-6 py-4 font-medium text-gray-900">{{ $item->kode_bom }}</td> --}}
                            <td class="px-6 py-4">{{ $item?->product?->name ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $item->total_materials }}</td>
                            <td class="px-6 py-4 text-center space-x-2">
                                <a href="{{ route('boms.detail', $item->product_id) }}" 
                                   class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                    Lihat
                                </a>
                                <form action="{{ route('boms.destroy', $item->product_id) }}" method="POST" 
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600"
                                        onclick="return confirm('Yakin ingin menghapus BOM ini?')">
                                        Hapus
                                    </button>
                                </form>
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
