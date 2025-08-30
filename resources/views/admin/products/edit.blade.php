@section('title', 'Edit Products')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Product
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded shadow">
         <form action="{{ route('products.update', $products->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                @include('admin.products.partials.form', ['products' => $products])


            </form>
    </div>
</x-app-layout>