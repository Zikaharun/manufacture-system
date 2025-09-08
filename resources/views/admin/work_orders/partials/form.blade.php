@csrf
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Product -->
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Product</label>
        <select name="product_id" required
            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="">-- Select Product --</option>
            @foreach ($products as $product)
                <option value="{{ $product->id }}" 
                    {{ old('product_id', $workOrder->product_id ?? '') == $product->id ? 'selected' : '' }}>
                    {{ $product->name }}
                </option>
            @endforeach
        </select>
        @error('product_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <!-- Quantity -->
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Quantity</label>
        <input type="number" name="quantity" min="1" required
            value="{{ old('quantity', $workOrder->quantity ?? '') }}"
            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        @error('quantity') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <!-- Planned Start Date -->
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Planned Start Date</label>
        <input type="date" name="planned_start_date" id="planned_start_date" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
         value="{{ old('planned_start_date', optional($workOrder->planned_start_date)->format('Y-m-d')) }}" required>
                @error('planned_start_date')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
    </div>

    <!-- Planned End Date -->
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Planned End Date</label>
        <input type="date" name="planned_end_date"
            value="{{ old('planned_start_date', optional($workOrder->planned_end_date)->format('Y-m-d')) }} ?? '') }}"
            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
    </div>

    <!-- Status (only for edit) -->
    @if(isset($workOrder))
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Status</label>
            <select name="status"
                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @foreach (['planned','in_progress','completed','canceled'] as $status)
                    <option value="{{ $status }}" {{ old('status', $workOrder->status) == $status ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
        </div>
    @endif
</div>

<!-- Submit Button -->
<div class="mt-6">
    <button type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-md">
        {{ isset($workOrder) ? 'Update Work Order' : 'Create Work Order' }}
    </button>
</div>
