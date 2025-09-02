    <div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded shadow">

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="name">Name</label>
                <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" value="{{ old('name', optional($materials)->name) }}" required>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="name">Unit</label>
                <input type="text" name="unit" id="unit" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" value="{{ old('Unit', optional($materials)->unit) }}" required>
                @error('unit')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="name">Cost price</label>
                <input type="number" name="cost_price" id="cost_price" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" value="{{ old('cost_price', optional($materials)->cost_price) }}" required>
                @error('cost_price')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="name">Stock</label>
                <input type="number" name="stock" id="stock" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" value="{{ old('stock', optional($materials)->stock) }}" required>
                @error('stock')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="name">Minimum Stock</label>
                <input type="number" name="minimum_stock" id="minimum_stock" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" value="{{ old('minimum_stock', optional($materials)->minimum_stock) }}" required>
                @error('minimum_stock')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
    </div>