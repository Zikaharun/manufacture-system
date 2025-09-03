<?php 

namespace App\Services;

use App\Repositories\SupplierRepository;

class SupplierService
{
    protected SupplierRepository $supplierRepository;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->SupplierRepository = $supplierRepository;
    }

    public function get($search = null)
    {
        return $this->supplierRepository->getAll($search);
    }

    public function findById(string $id)
    {
        return $this->supplierRepository->findById($id);
    }

    public function create(array $data)
    {
        return $this->supplierRepository->create($data);
    }

    public function update(string $id, array $data)
    {
        $supplier = $this->supplierRepository->findById($id);
        

        return $this->supplierRepository->update($supplier, $data);
    }

    public function delete(string $id)
    {
        $supplier = $this->supplierRepository->findById($id);

        return $supplier->delete();
    }
}