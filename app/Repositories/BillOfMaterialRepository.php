<?php 

namespace App\Repositories;

use App\Models\BillOfMaterial;

class BillOfMaterialRepository
{
    public function getAll()
    {
        return BillOfMaterial::with(['product', 'material'])
        ->select( 'product_id')
        ->selectRaw('count(material_id) as total_materials')
        ->groupBy('product_id')
        ->paginate(10);
    }

    public function getByProductId(string $productId)
    {
        return BillOfMaterial::with('material')
            ->where('product_id', $productId)
            ->get();
    }

    public function updateMaterialByProduct(string $productId, string $materialId, array $data)
    {
        $bom = BillOfMaterial::where('product_id', $productId)
            ->where('material_id', $materialId)
            ->firstOrFail();

        $bom->update($data);

        return $bom;
    }

    public function findById(string $id)
    {
        return BillOfMaterial::with(['product', 'material'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return BillOfMaterial::create($data);
    }


    public function update(string $id, array $data)
    {
        $bom = BillOfMaterial::findOrFail($id);
        $bom->update($data);

        return $bom;
    }


    public function delete(string $id)
    {

        $bom = BillOfMaterial::findOrFail($id);
        return $bom->delete();
    }
}