<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MaterialUsage;
use App\Models\StockMoveMent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MaterialUsageController extends Controller
{
    //
 // Menampilkan daftar material usage
    public function index()
    {
        $usages = MaterialUsage::with(['workOrder', 'material', 'user'])
            ->latest()
            ->paginate(20);

        return view('admin.material_usages.index', compact('usages'));
    }

    // Menampilkan detail material usage
    public function show($id)
    {
        $usage = MaterialUsage::with(['workOrder', 'material', 'user'])
            ->findOrFail($id);

        return view('admin.material_usages.show', compact('usage'));
    }

    public function create()
    {
        return view('material_usages.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'work_order_id' => 'required|uuid',
        'material_id'   => 'required|uuid',
        'quantity'      => 'required|numeric|min:0.001',
        'used_by'       => 'required|uuid',
    ]);

    // 1. Simpan penggunaan material
    $usage = MaterialUsage::create([
        'id'            => Str::uuid(),
        'work_order_id' => $request->work_order_id,
        'material_id'   => $request->material_id,
        'quantity'      => $request->quantity,
        'used_by'       => $request->used_by,
    ]);

    // 2. Kurangi stok material
    $material = Material::findOrFail($request->material_id);
    if ($material->stock < $request->quantity) {
        return back()->withErrors(['quantity' => 'Stok material tidak mencukupi.']);
    }
    $material->stock -= $request->quantity;
    $material->save();

    // 3. Catat ke stock_movements (status out)
    StockMoveMent::create([
        'id'          => Str::uuid(),
        'material_id' => $material->id,
        'warehouse_id' => '01990e7a-36af-7370-8e13-3ff47a54fdc2',
        'quantity'    => -$request->quantity,
        'type'      => 'out', // bisa "in" atau "out"
        'reference'   => 'MaterialUsage: ' . $usage->workOrder->wo_code, // opsional untuk tracking
        'created_by'  => $request->used_by,
    ]);

    return redirect()
        ->route('staff.work_orders.show', $request->work_order_id)
        ->with('success', 'Material usage recorded & stock updated.');
}

    public function edit(MaterialUsage $materialUsage)
    {
        return view('material_usages.edit', compact('materialUsage'));
    }

    public function update(Request $request, MaterialUsage $materialUsage)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:0.001',
        ]);

        $materialUsage->update($request->only('quantity'));

        return redirect()->route('material_usages.index')->with('success', 'Material usage updated.');
    }

    public function destroy(MaterialUsage $materialUsage)
    {
    $workOrderId = $materialUsage->work_order_id;

    $materialUsage->delete();

    $role = auth()->user()->role->name;

    switch ($role) {
        case 'admin':
            return redirect()
                ->route('material_usages.index')
                ->with('success', 'Material usage deleted.');
        case 'staff':
            return redirect()
                ->route('staff.work_orders.show', $workOrderId) // ⬅️ kirim id ke route show
                ->with('success', 'Material usage deleted.');
        default:
            abort(403, 'Unauthorized');
    }
    }

}
