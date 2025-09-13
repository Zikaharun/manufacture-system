@section('title','Create Purchase orders')

<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Buat Purchase Order</h1>

        <form action="{{ route('staff.purchase_orders.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Supplier --}}
            <div>
                <label class="block text-sm font-medium mb-2">Supplier</label>
                <select name="supplier_id" class="w-full border-gray-300 rounded-lg shadow-sm">
                    <option value="" disabled selected>Pilih Supplier</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Tanggal Order --}}
            <div>
                <label class="block text-sm font-medium mb-2">Tanggal Order</label>
                <input type="date" name="order_date" 
                       class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>

            {{-- Items --}}
            <div id="items-wrapper" class="space-y-4">
                <h2 class="text-lg font-semibold">Items</h2>

                <div class="flex gap-4 items-center">
                    <select name="items[0][material_id]" class="border-gray-300 rounded-lg">
                        <option value="" disabled selected>Pilih Material</option>
                        @foreach($materials as $material)
                            <option value="{{ $material->id }}">{{ $material->name }}</option>
                        @endforeach
                    </select>

                    <input type="number" step="0.01" min="0" 
                           name="items[0][quantity]" 
                           placeholder="Qty" 
                           class="w-24 border-gray-300 rounded-lg">
                    
                    <input type="text" 
                           name="items[0][unit]" 
                           placeholder="Kg" 
                           class="w-24 border-gray-300 rounded-lg">

                    <input type="number" step="0.01" min="0" 
                           name="items[0][unit_price]" 
                           placeholder="Harga Satuan" 
                           class="w-32 border-gray-300 rounded-lg">
                </div>
            </div>

            {{-- Tombol Tambah Item --}}
            <button type="button" id="add-item" 
                    class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">
                + Tambah Item
            </button>

            {{-- Action Button --}}
            <div>
                <button type="submit" 
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    Simpan
                </button>
                <a href="{{ route('staff.purchase_orders.index') }}" 
                   class="ml-2 text-gray-600">
                    Batal
                </a>
            </div>
        </form>
    </div>

    {{-- Script Tambah Item --}}
    <script>
        let itemIndex = 1;
        document.getElementById('add-item').addEventListener('click', function() {
            const wrapper = document.getElementById('items-wrapper');
            const div = document.createElement('div');
            div.classList.add('flex', 'gap-4', 'items-center');
            div.innerHTML = `
                <select name="items[${itemIndex}][material_id]" class="border-gray-300 rounded-lg">
                    <option value="" disabled selected>Pilih Material</option>
                    @foreach($materials as $material)
                        <option value="{{ $material->id }}">{{ $material->name }}</option>
                    @endforeach
                </select>

                <input type="number" step="0.01" min="0" 
                       name="items[${itemIndex}][quantity]" 
                       placeholder="Qty" 
                       class="w-24 border-gray-300 rounded-lg">

                <input type="text" 
                       name="items[${itemIndex}][unit]" 
                       placeholder="Kg" 
                       class="w-24 border-gray-300 rounded-lg">

                <input type="number" step="0.01" min="0" 
                       name="items[${itemIndex}][unit_price]" 
                       placeholder="Harga Satuan" 
                       class="w-32 border-gray-300 rounded-lg">
            `;
            wrapper.appendChild(div);
            itemIndex++;
        });
    </script>
</x-app-layout>
