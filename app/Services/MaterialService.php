<?php 

namespace App\Services;

use App\Repositories\MaterialRepository;
use Illuminate\Support\Facades\Log;



class MaterialService
{
    // Product service methods would go here
    protected MaterialRepository $materialRepository;

    public function __construct(MaterialRepository $materialRepository)
    {
        $this->materialRepository = $materialRepository;
    }

    public function getAllMaterials($search = null)
    {
        return $this->materialRepository->getAllMaterials($search);
    }

    public function getById($id)
    {
        return $this->materialRepository->findMaterialById($id);
    }

    public function create(array $data)
    {
        if (!isset($data['cost_price']) || $data['cost_price'] <= 0) {
            Log::error('Invalid materials cost price', ['data' => $data]);
            throw new \InvalidArgumentException('Price must be a positive number.');
        }

        return $this->materialRepository->createMaterial($data);
    }

    public function update($id, array $data)
    {
        $material = $this->materialRepository->findMaterialById($id);
        return $this->materialRepository->updateMaterial($material, $data);
    }

    public function delete($id)
    {
        $material = $this->materialRepository->findMaterialById($id);
        return $this->materialRepository->deleteMaterial($material);
    }
}