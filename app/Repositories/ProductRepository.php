<?php 

namespace App\Repositories;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductRepository
{
    public function getAllProducts($search = null)
    {
        $query = Product::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('sku', 'like', '%' . $search . '%');
        }

        Log::info('Fetching products', ['search' => $search]);
        return $query->paginate(10);
    }

    public function findProductById($id)
    {
        Log::info('Finding product by ID', ['id' => $id]);
        return Product::findOrFail($id);
    }   

    public function createProduct(array $data)
    {
        Log::info('Creating product', ['data' => $data]);
        return Product::create($data);
    }

    public function updateProduct(Product $product , array $data)
    {
        Log::info('Updating product', ['id' => $product->id, 'data' => $data]);
        $product->update($data);
        return $product;
    }

    public function deleteProduct(Product $product)
    {
        Log::warning('Deleting product', ['id' => $product->id]);
        return $product->delete();
    }
}