



    <div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded shadow">
        {{-- <form action="{{ route('products.store') }}" method="POST">
            @csrf --}}

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="name">Name</label>
                <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" value="{{ old('name', optional($products)->name) }}" required>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="name">Sku</label>
                <input type="text" name="sku" id="sku" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" value="{{ old('sku', optional($products)->sku) }}" required>
                @error('sku')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="name">Unit</label>
                <input type="text" name="unit" id="unit" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" value="{{ old('unit', optional($products)->unit) }}" required>
                @error('unit')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>


            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="price">Price</label>
                <input type="number" name="price" id="price" step="0.01" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" value="{{ old('price', optional($products)->price) }}" required>
                @error('price')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        {{-- </form> --}}
    </div>