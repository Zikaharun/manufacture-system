@section('title', 'Add Suppliers')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Supplier
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded shadow">
         <form action="{{ route('suppliers.store') }}" method="POST" class="space-y-6">
                @csrf

                @include('admin.suppliers.partials.form', ['suppliers' => null])

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
         </form>
    </div>
</x-app-layout>