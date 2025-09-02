<?php 

namespace App\Services;

use App\Repositories\BillOfMaterialRepository;

class BillOfMaterialService
{
    protected BillOfMaterialRepository $bom;

    public function __construct(BillOfMaterialRepository $bom)
    {
        $this->bom = $bom;
    }

    public function gettAll()
    {
        return $this->bom->getAll();
    }

    public function getById(string $id)
    {
        return $this->bom->findById($id);
    }

    public function getmaterialsByProduct(string $productId)
    {
        return $this->bom->getByProductId($productId);
    }

    public function addBOM(array $data)
    {
        return $this->bom->create($data);
    }

    public function updateBOM(string $id, array $data)
    {
        return $this->bom->update($id, $data);
    }

    public function updateMaterialByProductId(string $productId, string $materialId, array $data)
    {
        return $this->bom->updateMaterialByProduct($productId, $materialId, $data);
    }

    public function deleteBOM(string $id)
    {
        return $this->bom->delete($id);
    }
}