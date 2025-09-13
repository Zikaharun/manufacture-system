
@section('title', 'Create Work orders')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Work Orders
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-8">
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Create Work Order</h2>

        <form action="{{ route('work_orders.store') }}" method="POST">
            @include('admin.work_orders.partials.form', ['workOrder' => null] )
        </form>
    </div>
</div>
</x-app-layout>