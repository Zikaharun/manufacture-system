@csrf
<div class="">
    <!-- Status (only for edit) -->
    @if(isset($workOrder))
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Status</label>
            <select name="status"
                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @foreach (['planned','in_progress','completed','canceled'] as $status)
                    <option  value="{{ $status }}" {{ old('status', $workOrder->status) == $status ? 'selected' : '' }}>
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
