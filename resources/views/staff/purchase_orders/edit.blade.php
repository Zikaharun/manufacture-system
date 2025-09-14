@section('title','Edit Purchase Order')

<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-2xl font-bold mb-6">Edit Purchase Order</h1>

        <form action="{{ route('staff.purchase_orders.update', $order->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Supplier (tidak bisa diubah) --}}
            <div>
                <label class="block text-sm font-medium mb-2">Supplier</label>
                <select name="supplier_id" disabled class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-100">
                    <option>{{ $order->supplier->name }}</option>
                </select>
            </div>

            {{-- Tanggal Order (tidak bisa diubah) --}}
            <div>
                <label class="block text-sm font-medium mb-2">Tanggal Order</label>
                <input type="date" name="order_date" value="{{ $order->order_date }}" disabled
                       class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-100">
            </div>

            {{-- Items --}}
            <div id="items-wrapper" class="space-y-4">
                <h2 class="text-lg font-semibold">Items</h2>
                @foreach($order->items as $i => $item)
                    <div class="flex gap-4 items-center">
                        {{-- Dropdown material --}}
                        <select name="items[{{ $i }}][material_id]" class="border-gray-300 rounded-lg">
                            <option value="" disabled>Pilih Material</option>
                            @foreach($materials as $material)
                                <option value="{{ $material->id }}" @if($item->material_id == $material->id) selected @endif>
                                    {{ $material->name }}
                                </option>
                            @endforeach
                        </select>

                        {{-- Quantity --}}
                        <input type="number" step="0.01" name="items[{{ $i }}][quantity]"
                               value="{{ $item->quantity }}" class="w-24 border-gray-300 rounded-lg">

                        {{-- Unit --}}
                        <input type="text" name="items[{{ $i }}][unit]"
                               value="{{ $item->unit }}" class="w-24 border-gray-300 rounded-lg">

                        {{-- Unit Price --}}
                        <input type="number" step="0.01" name="items[{{ $i }}][unit_price]"
                               value="{{ $item->unit_price }}" class="w-32 border-gray-300 rounded-lg">
                    </div>
                @endforeach
            </div>

            {{-- Tombol Tambah Item --}}
            <button type="button" id="add-item"
                    class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">
                + Tambah Item
            </button>

            {{-- Action Button --}}
            <div>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    Update
                </button>
                <a href="{{ route('staff.purchase_orders.index') }}" class="ml-2 text-gray-600">Batal</a>
            </div>
        </form>
    </div>

    {{-- Script Tambah Item --}}
    <script>
        let itemIndex = {{ count($order->items) }};
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

