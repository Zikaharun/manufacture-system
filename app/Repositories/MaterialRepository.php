<?php 

namespace App\Repositories;

use App\Models\Material;
use Illuminate\Support\Facades\Log;

class MaterialRepository
{


    public function getAllMaterials($search = null)

    {
        $query = Material::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('unit', 'like', '%' . $search . '%')
                  ;
        }

        Log::info('Fetching materials', ['search' => $search]);
        return $query->paginate(10);
    }

    public function findMaterialById($id)
    {
        Log::info('Finding materials by ID', ['id' => $id]);
        return Material::findOrFail($id);
    }   

    public function createMaterial(array $data)
    {
        Log::info('Creating material', ['data' => $data]);
        return Material::create($data);
    }

    public function updateMaterial(Material $product , array $data)
    {
        Log::info('Updating material', ['id' => $product->id, 'data' => $data]);
        $product->update($data);
        return $product;
    }

    public function deleteMaterial(Material $product)
    {
        Log::warning('Deleting material', ['id' => $product->id]);
        return $product->delete();
    }
}