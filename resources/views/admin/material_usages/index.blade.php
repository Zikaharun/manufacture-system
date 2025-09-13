@section('title', 'Material Usages')

<x-app-layout>
<div class="p-6">
    <h1 class="text-xl font-bold mb-4">Monitoring Material Usages</h1>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-lg">
        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-300">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-6 py-3">#</th>
                    <th class="px-6 py-3">Work Order</th>
                    <th class="px-6 py-3">Material</th>
                    <th class="px-6 py-3">Quantity</th>
                    <th class="px-6 py-3">Used By</th>
                    <th class="px-6 py-3">Date</th>
                    <th class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usages as $index => $usage)
                    <tr class="border-b dark:border-gray-700">
                        <td class="px-6 py-4">{{ $index + $usages->firstItem() }}</td>
                        <td class="px-6 py-4">{{ $usage->workOrder->wo_code ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $usage->material->name ?? '-' }}</td>
                        <td class="px-6 py-4">{{ intval($usage->quantity) }}</td>
                        <td class="px-6 py-4">{{ $usage->user->name ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $usage->created_at->setTimezone('Asia/Jakarta')->format('d M Y H:i') }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('material_usages.show', $usage->id) }}" class="text-blue-600 hover:text-blue-800">View</a>
                            <form action="{{ route('material_usages.destroy', $usage->id) }}" method="POST" 
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="px-3 py-1  text-red-500 rounded mb-2 hover:text-red-600"
                                        onclick="return confirm('Yakin ingin menghapus Material_usages ini?')">
                                        Hapus
                                    </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            Belum ada aktivitas penggunaan material
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $usages->links() }}
    </div>
</div>
</x-app-layout>