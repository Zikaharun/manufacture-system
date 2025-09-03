<?php 

namespace App\Repositories;

use App\Models\WareHouse;
use Illuminate\Support\Facades\Log;

class WareHouseRepository 
{
    public function getAll($search = null)
    {
        $query = WareHouse::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('location', 'like', '%' . $search . '%');
        }

        Log::info('Fetching warehouses', ['search' => $search]);
        return $query->paginate(10);
    }

    public function findById($id)
    {
        Log::info('Finding product by ID', ['id' => $id]);
        return WareHouse::findOrFail($id);
    }   

    public function createWareHouse(array $data)
    {
        Log::info('Creating warehouse', ['data' => $data]);
        return WareHouse::create($data);
    }

    public function updateWareHouse(WareHouse $wareHouse , array $data)
    {
        Log::info('Updating warehouse', ['id' => $wareHouse->id, 'data' => $data]);
        $wareHouse->update($data);
        return $wareHouse;
    }

    public function deleteWareHouse(WareHouse $wareHouse)
    {
        Log::warning('Deleting product', ['id' => $wareHouse->id]);
        return $wareHouse->delete();
    }
}