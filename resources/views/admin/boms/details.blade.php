<x-app-layout>
<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Detail Bahan Baku untuk Produk</h2>

    @if($materials->isEmpty())
        <p class="text-gray-500">Belum ada bahan baku yang terdaftar untuk produk ini.</p>
    @else
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">Nama</th>
                    <th class="border border-gray-300 px-4 py-2">Unit</th>
                    <th class="border border-gray-300 px-4 py-2">Harga</th>
                    <th class="border border-gray-300 px-4 py-2">Stok</th>
                    <th class="border border-gray-300 px-4 py-2">Minimum Stok</th>
                    <th class="border border-gray-300 px-4 py-2">Kuantitas Dipakai</th>
                    <th class="border border-gray-300 px-4 py-2">action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materials as $item)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->material->name ?? '-' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->material->unit ?? '-' }}</td>
                        <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($item->material->cost_price, 0, ',', '.') }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ intval($item->material->stock ?? '-') }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ intval($item->material->minimum_stock) ?? '-' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ rtrim(rtrim($item->quantity, '0'), '.') ?? '-' }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <a href="{{ route('boms.edit', $item->id) }}"
                            class="inline-block px-4 mb-2 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1 transition">
                            Edit Materials
                            </a>
                            <form action="{{ route('boms.destroy', $item->id) }}" method="POST" 
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
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="mt-4">
        <a href="{{ route('boms.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Kembali</a>
    </div>
</div>
</x-app-layout>