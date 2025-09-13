<?php

namespace App\Http\Controllers;

use App\Models\BillOfMaterial;
use App\Models\Material;
use App\Models\Product;
use App\Services\BillOfMaterialService;
use Illuminate\Http\Request;

class BillOfMaterialController extends Controller
{
    //
    protected BillOfMaterialService $bom;

    public function __construct(BillOfMaterialService $bom)
    {
        $this->bom = $bom;
    }

    public function index()
    {
        $boms = $this->bom->gettAll();
        
        $role = auth()->user()->role->name;

        switch ($role) {
            case 'admin' :
                return view('admin.boms.index', compact('boms'));
            case 'staff' :
                return view('staff.boms.index', compact('boms'));
            default:
            abort(403, 'Unauthorized');
        }

    }

    public function showByProduct(string $productId)
    {
        $materials = $this->bom->getmaterialsByProduct($productId);
        

         $role = auth()->user()->role->name;

        switch ($role) {
            case 'admin' :
                return view('admin.boms.details', compact('materials'));
            case 'staff' :
                return view('staff.boms.show', compact('materials'));
            default:
            abort(403, 'Unauthorized');
        }
    }

    public function create()
    {
        $products = Product::select('id', 'name')->orderBy('name')->get();
        $materials = Material::select('id', 'name')->orderBy('name')->get();

        return view('admin.boms.create', compact('products', 'materials'));
    }

     // Tambah BOM baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|uuid|exists:products,id',
            'material_id' => 'required|uuid|exists:materials,id',
            'quantity' => 'required|numeric|min:0',
        ]);

        $this->bom->addBOM($data);
        return redirect()->route('boms.index')->with('success', 'boms has been added!');

    }

    public function edit($id)
    {
        $boms = $this->bom->getById($id);
        
         $products = Product::get();
        $materials = Material::get();

        return view('admin.boms.edit', compact('boms', 'products', 'materials'));
    }


    // Update BOM
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'product_id' => 'required|uuid|exists:products,id',
            'material_id' => 'required|uuid|exists:materials,id',
            'quantity' => 'required|numeric|min:0',
        ]);

        $this->bom->updateBOM($id, $data);
        return redirect()->route('boms.index')->with('success', 'boms has been updated!');
    }

    public function updateMaterialsByProductId(Request $request, string $productId, string $materialId)
    {
        $validated = $request->validate([
            'quantity' => 'required|numeric|min:0',
        ]);

        $this->bom->updateMaterialByProductId($productId, $materialId, $validated);

        return redirect()->back()->with('success', 'Material in Bill of materials has been updated!');
    }




    // Hapus BOM
    public function destroy(string $id)
    {
        $this->bom->deleteBOM($id);
        return redirect()->route('boms.index')->with('success', 'boms has been deleted!');
    }
}
