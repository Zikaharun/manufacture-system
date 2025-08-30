<?php 

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    // Product service methods would go here
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts($search = null)
    {
        return $this->productRepository->getAllProducts($search);
    }

    public function getById($id)
    {
        return $this->productRepository->findProductById($id);
    }

    public function create(array $data)
    {
        if (!isset($data['price']) || $data['price'] <= 0) {
            Log::error('Invalid product price', ['data' => $data]);
            throw new \InvalidArgumentException('Price must be a positive number.');
        }

        return $this->productRepository->createProduct($data);
    }

    public function update($id, array $data)
    {
        $product = $this->productRepository->findProductById($id);
        return $this->productRepository->updateProduct($product, $data);
    }

    public function delete($id)
    {
        $product = $this->productRepository->findProductById($id);
        return $this->productRepository->deleteProduct($product);
    }
}