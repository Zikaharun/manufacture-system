<?php

namespace App\Http\Controllers;

use App\Models\MaterialUsage;
use Illuminate\Http\Request;

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

        MaterialUsage::create([
            'id'            => Str::uuid(),
            'work_order_id' => $request->work_order_id,
            'material_id'   => $request->material_id,
            'quantity'      => $request->quantity,
            'used_by'       => $request->used_by,
        ]);

        return redirect()->route('material_usages.index')->with('success', 'Material usage recorded.');
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
        $materialUsage->delete();

        return redirect()->route('material_usages.index')->with('success', 'Material usage deleted.');
    }

}
