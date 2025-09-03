<?php 

namespace App\Services;

use App\Repositories\WareHouseRepository;

class WareHouseServices
{
    // Product service methods would go here
    protected WareHouseRepository $wareHouseRepository;

    public function __construct(WareHouseRepository $wareHouseRepository)
    {
        $this->wareHouseRepository = $wareHouseRepository;
    }

    public function getAll($search = null)
    {
        return $this->wareHouseRepository->getAll($search);
    }

    public function getById($id)
    {
        return $this->wareHouseRepository->findById($id);
    }

    public function create(array $data)
    {

        return $this->wareHouseRepository->createWareHouse($data);
    }

    public function update($id, array $data)
    {
        $wareHouse = $this->wareHouseRepository->findById($id);
        return $this->wareHouseRepository->updateWareHouse($wareHouse, $data);
    }

    public function delete($id)
    {
        $wareHouse = $this->wareHouseRepository->findById($id);
        return $this->wareHouseRepository->deleteWareHouse($wareHouse);
    }
}
