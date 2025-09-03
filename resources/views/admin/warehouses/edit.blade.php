@section('title', 'Edit Warehouse')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Warehouse
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded shadow">
         <form action="{{ route('warehouse.update', $warehouses->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                @include('admin.warehouses.partials.form', ['warehouses' => $warehouses])


            </form>
    </div>
</x-app-layout>