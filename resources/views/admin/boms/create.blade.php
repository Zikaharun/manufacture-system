<x-app-layout>
<div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-700">Create Bill of Material</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
            <ul class="list-disc pl-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('boms.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Select Product -->
        <div>
            <label for="product_id" class="block text-sm font-medium text-gray-700">Product</label>
            <select name="product_id" id="product_id" 
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">-- Select Product --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Select Material -->
        <div>
            <label for="material_id" class="block text-sm font-medium text-gray-700">Material</label>
            <select name="material_id" id="material_id" 
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">-- Select Material --</option>
                @foreach($materials as $material)
                    <option value="{{ $material->id }}" {{ old('material_id') == $material->id ? 'selected' : '' }}>
                        {{ $material->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Quantity -->
        <div>
            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
            <input type="number" step="0.01" name="quantity" id="quantity" value="{{ old('quantity') }}"
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
            <a href="{{ route('boms.index') }}" 
                class="mr-3 inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-300">
                Cancel
            </a>
            <button type="submit" 
                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700">
                Save
            </button>
        </div>
    </form>
</div>
</x-app-layout>