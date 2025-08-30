<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    //
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $search = $request->query('search', '');
        Log::info('Search query: ' . $search); // Log the search query

        $products = $this->productService->getAllProducts($search);

        return view('admin.products.index', compact('products', 'search'));

    }

    public function create(Request $request)
    {
        return view('admin.products.create');
    }

    public function store( Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:255|unique:products,sku',
            'unit' => 'required|string|max:50',
            'price' => 'required|numeric|min:0'
        ]);

        $this->productService->create($data);
        return redirect()->route('products.index')->with('success', 'products has been added!');
    }

    public function show($id)
    {
        $product = $this->productService->getById($id);
        return view('products.detail', compact('product'));
    }

    public function edit($id)
    {
        $products = $this->productService->getById($id);
        return view('admin.products.edit', compact('products'));
    }

    public function update (Request $request, $id)
    {
         $data = $request->validate([
            'name'  => 'sometimes|string|max:255',
            'sku'   => 'sometimes|string|max:255|unique:products,sku,' . $id,
            'unit'  => 'sometimes|string|max:50',
            'price' => 'sometimes|numeric|min:0',
        ]);

        $this->productService->update($id, $data);
        return redirect()->route('products.index')->with('success', 'products has been updated!');
    }

    public function destroy($id)
    {
        $this->productService->delete($id);
        return redirect()->route('products.index')->with('success','products has been deleted!');
    }
}
