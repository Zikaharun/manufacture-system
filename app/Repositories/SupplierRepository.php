<?php 

namespace App\Repositories;

use App\Models\Supplier;
use Illuminate\Support\Facades\Log;

class SupplierRepository
{
     public function getAll($search = null)
    {
        $query = Supplier::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('contact_person', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('phone', 'like','%' . $search . '%' )
                  ->orWhere('address', 'like', '%' . $search . '%');
        }

        Log::info('Fetching suppliers', ['search' => $search]);
        return $query->paginate(10);
    }

    public function findById($id)
    {
        Log::info('Finding supplier by ID', ['id' => $id]);
        return Supplier::findOrFail($id);
    }   

    public function create(array $data)
    {
        Log::info('Creating supplier', ['data' => $data]);
        return Supplier::create($data);
    }

    public function update(Supplier $supplier , array $data)
    {
        Log::info('Updating warehouse', ['id' => $supplier->id, 'data' => $data]);
        $supplier->update($data);
        return $supplier;
    }

    public function delete(Supplier $supplier)
    {
        Log::warning('Deleting product', ['id' => $supplier->id]);
        return $supplier->delete();
    }
}