 <div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded shadow">

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="name">Name</label>
                <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" value="{{ old('name', optional($suppliers)->name) }}" required>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="name">Contact Person</label>
                <input type="text" name="contact_person" id="contact_person" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" value="{{ old('contact_person', optional($suppliers)->contact_person) }}" >
                @error('contact_person')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="name">Phone</label>
                <input type="text" name="phone" id="phone" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" value="{{ old('phone', optional($suppliers)->phone) }}" required>
                @error('phone')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="name">Email</label>
                <input type="email" name="email" id="email" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" value="{{ old('email', optional($suppliers)->email) }}" required>
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="name">Address</label>
                <textarea type="text" name="address" id="address" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" value="" >{{ old('address', optional($suppliers)->address) }}</textarea>
                @error('address')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
    </div>