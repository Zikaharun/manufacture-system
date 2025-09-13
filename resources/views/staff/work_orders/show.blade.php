{{-- resources/views/staff/work_orders/show.blade.php --}}
@section('title', 'Detail Work Order')

<x-app-layout>
<div class="bg-gray-50 min-h-screen py-12 px-4">
    <div class="max-w-5xl mx-auto">
        <div class="bg-white shadow-xl rounded-2xl p-10 space-y-10">

            {{-- Header --}}
            <div class="border-b pb-4">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">
                    Detail Work Order
                </h2>
                <p class="text-gray-500 text-sm">
                    Informasi lengkap Work Order beserta penggunaan material dan log produksi.
                </p>
            </div>

            {{-- Informasi Work Order --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <p><span class="font-semibold text-gray-700">Produk:</span> {{ $workOrder->product->name }}</p>
                    <p><span class="font-semibold text-gray-700">Quantity:</span> {{ $workOrder->quantity }}</p>
                    <p>
                        <span class="font-semibold text-gray-700">Status:</span> 
                        <span class="px-3 py-1 text-xs font-medium rounded-full 
                            @if($workOrder->status === 'completed') bg-green-100 text-green-700 
                            @elseif($workOrder->status === 'in_progress') bg-blue-100 text-blue-700 
                            @elseif($workOrder->status === 'canceled') bg-red-100 text-red-700 
                            @else bg-gray-200 text-gray-700 @endif">
                            {{ ucfirst($workOrder->status) }}
                        </span>
                    </p>
                </div>
                <div class="space-y-2">
                    <p><span class="font-semibold text-gray-700">Planned Start:</span> {{ $workOrder->planned_start_date }}</p>
                    <p><span class="font-semibold text-gray-700">Planned End:</span> {{ $workOrder->planned_end_date }}</p>
                </div>
            </div>

            {{-- Form Material Usage --}}
            <div class="border-t pt-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Tambah Material Usage</h3>
                <form action="{{ route('staff.material_usages.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <input type="hidden" name="work_order_id" value="{{ $workOrder->id }}">
                    <input type="hidden" name="used_by" value="{{ auth()->id() }}">

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Pilih Material</label>
                        <select name="material_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">-- Pilih Material --</option>
                            @foreach($materials as $material)
                                <option value="{{ $material->id }}">{{ $material->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Quantity</label>
                        <input type="number" step="0.001" name="quantity" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded-lg shadow transition">
                        Simpan Material Usage
                    </button>
                </form>
            </div>

            {{-- List Material Usages --}}
            @if($workOrder->materialUsages->count())
            <div class="border-t pt-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Daftar Material Usage</h3>
                <div class="overflow-hidden rounded-lg border border-gray-200">
                    <table class="min-w-full text-sm text-gray-700">
                        <thead class="bg-gray-100 text-gray-600 text-xs uppercase">
                            <tr>
                                <th class="px-4 py-3 text-left">Material</th>
                                <th class="px-4 py-3 text-left">Quantity</th>
                                <th class="px-4 py-3 text-left">Digunakan Oleh</th>
                                <th class="px-4 py-3 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($workOrder->materialUsages as $usage)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $usage->material->name }}</td>
                                    <td class="px-4 py-2">{{ intval($usage->quantity) }}</td>
                                    <td class="px-4 py-2">{{ $usage->user->name ?? '-' }}</td>
                                    <td class="px-4 py-2">
                                        <form action="{{ route('staff.material_usages.destroy', $usage->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus data ini?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            {{-- Form Production Log --}}
           <div class="border-t pt-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Tambah Production Log</h3>

                <form action="{{ route('staff.production_logs.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <input type="hidden" name="work_order_id" value="{{ $workOrder->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Jumlah Produksi</label>
                        <input type="number" name="quantity_produced" min="1"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Jumlah Reject (opsional)</label>
                        <input type="number" name="reject_quantity" min="0" value="0"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Produksi</label>
                        <input type="date" name="production_date" value="{{ now()->toDateString() }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                            required>
                    </div>

                    <button type="submit" 
                        class="bg-green-600 mt-4 hover:bg-green-700 text-white font-medium px-5 py-2 rounded-lg shadow transition">
                        Simpan Production Log
                    </button>
                </form>
            </div>

            
            {{-- List Material Usages --}}
            @if($workOrder->productionLogs->count())
            <div class="border-t pt-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Daftar Material Usage</h3>
                <div class="overflow-hidden rounded-lg border border-gray-200">
                    <table class="min-w-full text-sm text-gray-700">
                        <thead class="bg-gray-100 text-gray-600 text-xs uppercase">
                            <tr>
                                <th class="px-4 py-3 text-left">Products</th>
                                <th class="px-4 py-3 text-left">wo code</th>
                                <th class="px-4 py-3 text-left">production</th>
                                <th class="px-4 py-3 text-left">reject</th>
                                <th class="px-4 py-3 text-left">Digunakan Oleh</th>
                                <th class="px-4 py-3 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($workOrder->productionLogs as $usage)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $usage->workOrder->product->name }}</td>
                                    <td class="px-4 py-2">{{ $usage->WorkOrder->wo_code }}</td>
                                    <td class="px-4 py-2">{{ intval($usage->quantity_produced) }}</td>
                                    <td class="px-4 py-2">{{ intval($usage->reject_quantity) }}</td>
                                    <td class="px-4 py-2">{{ $usage->user->name ?? '-' }}</td>
                                    <td class="px-4 py-2">
                                        <form action="{{ route('staff.production_logs.destroy', $usage->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus data ini?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
</x-app-layout>

