
    <div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded shadow">
        {{-- <form action="{{ route('products.store') }}" method="POST">
            @csrf --}}

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="name">Name</label>
                <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" value="{{ old('name', optional($warehouses)->name) }}" required>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="name">location</label>
                <input type="text" name="location" id="location" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" value="{{ old('location', optional($warehouses)->location) }}" >
                @error('sku')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>



            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        {{-- </form> --}}
    </div>