<?php

namespace App\Http\Controllers;

use App\Services\WareHouseServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WareHouseController extends Controller
{
    //
    protected WareHouseServices $wareHouseServices;

    public function __construct(WareHouseServices $wareHouseServices)
    {
        $this->wareHouseServices = $wareHouseServices;
    }

     public function index(Request $request)
    {
        $search = $request->query('search', '');
        Log::info('Search query: ' . $search); // Log the search query

        $warehouses = $this->wareHouseServices->getAll($search);

        return view('admin.warehouses.index', compact('warehouses', 'search'));

    }



    public function create()
    {
        return view('admin.warehouses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'string|required|max:255',
            'location' => 'string|max:255|nullable'
        ]);

        $this->wareHouseServices->create($data);

        return redirect()->route('warehouses.index')->with('Warehouse has been added!');
    }

    public function edit(string $id)
    {
        $warehouses = $this->wareHouseServices->getById($id);
        
        return view('admin.warehouses.edit', compact('warehouses'));
    }

    public function update(Request $request, string $id)
    {

        $data = $request->validate([
            'name' => 'string|required|max:255',
            'location' => 'string|max:255|nullable'
        ]);

        $this->wareHouseServices->update($id, $data);

        return redirect()->route('warehouses.index')->with('success', 'Warehouse has been updated!');

    }

    public function destroy(string $id)
    {
        $this->wareHouseServices->delete($id);
        
        return redirect()->route('warehouses.index')->with('success', 'Warehouse has been deleted!');
    }
}
