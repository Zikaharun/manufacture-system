<?php

namespace App\Http\Controllers;

use App\Services\MaterialService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MaterialController extends Controller
{
    //
        protected MaterialService $materialService;

    public function __construct(MaterialService $materialService)
    {
        $this->materialService = $materialService;
    }

    public function index(Request $request)
    {
        $search = $request->query('search', '');
        Log::info('Search query: ' . $search); // Log the search query

        $materials = $this->materialService->getAllMaterials($search);

        

        $role = auth()->user()->role->name;

        switch ($role) {
            case 'admin' :
                return view('admin.materials.index', compact('materials', 'search'));
            case 'staff' :
                return view('staff.materials.index', compact('materials', 'search'));
            default:
            abort(403, 'Unauthorized');
        }

    }

    public function create(Request $request)
    {
        return view('admin.materials.create');
    }

    public function store( Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'nullable|string|max:255|unique:products,sku',
            'cost_price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'minimum_stock' => 'required|numeric|min:0'
        ]);

        $this->materialService->create($data);
        return redirect()->route('materials.index')->with('success', 'materials has been added!');
    }

    public function show($id)
    {
        $material = $this->materialService->getById($id);
        
        $role = auth()->user()->role->name;

        switch ($role) {
            case 'admin' :
                return view('admin.materials.show', compact('material'));
            case 'staff' :
                return view('staff.materials.show', compact('material'));
            default:
            abort(403, 'Unauthorized');
        }
    }

    public function edit($id)
    {
        $materials = $this->materialService->getById($id);
        return view('admin.materials.edit', compact('materials'));
    }

    public function update (Request $request, $id)
    {
         $data = $request->validate([
            'name'  => 'sometimes|string|max:255',
            'unit' => 'sometimes|string|max:255|unique:products,sku,' . $id,
            'cost_price' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|numeric|min:0',
            'minimum_stock' => 'sometimes|numeric|min:0'
        ]);

        $this->materialService->update($id, $data);
        return redirect()->route('materials.index')->with('success', 'materials has been updated!');
    }

    public function destroy($id)
    {
        $this->materialService->delete($id);
        return redirect()->route('materials.index')->with('success','materials has been deleted!');
    }
}
