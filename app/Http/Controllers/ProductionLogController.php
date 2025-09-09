<?php

namespace App\Http\Controllers;

use App\Models\ProductionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductionLogController extends Controller
{
    //
  // Menampilkan daftar hasil produksi
    public function index()
    {
         $role = auth()->user()->role->name;

        $logs = ProductionLog::with(['workOrder', 'user'])
            ->latest()
            ->paginate(20);

        switch ($role) {
            case 'admin' :
                return view('admin.production_logs.index', compact('logs'));
            case 'staff' :
                return view('staff.production_logs.index', compact('logs'));
            default:
            abort(403, 'Unauthorized');
        }

    }

    // Menampilkan detail produksi
    public function show($id)
    {
        $log = ProductionLog::with(['workOrder', 'user'])
            ->findOrFail($id);

        return view('admin.production_logs.show', compact('log'));
    }

    public function create()
    {
        return view('production_logs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'          => 'required|uuid',
            'work_order_id'    => 'required|uuid',
            'quantity_produced'=> 'required|integer|min:1',
            'reject_quantity'  => 'nullable|integer|min:0',
            'production_date'  => 'required|date',
        ]);

        ProductionLog::create([
            'id'               => Str::uuid(),
            'user_id'          => $request->user_id,
            'work_order_id'    => $request->work_order_id,
            'quantity_produced'=> $request->quantity_produced,
            'reject_quantity'  => $request->reject_quantity ?? 0,
            'production_date'  => $request->production_date,
        ]);

        return redirect()->route('production_logs.index')->with('success', 'Production log recorded.');
    }

    public function edit(ProductionLog $productionLog)
    {
        return view('production_logs.edit', compact('productionLog'));
    }

    public function update(Request $request, ProductionLog $productionLog)
    {
        $request->validate([
            'quantity_produced'=> 'required|integer|min:1',
            'reject_quantity'  => 'nullable|integer|min:0',
            'production_date'  => 'required|date',
        ]);

        $productionLog->update($request->only([
            'quantity_produced',
            'reject_quantity',
            'production_date',
        ]));

        return redirect()->route('production_logs.index')->with('success', 'Production log updated.');
    }

    public function destroy(ProductionLog $productionLog)
    {
        $productionLog->delete();

        return redirect()->route('production_logs.index')->with('success', 'Production log deleted.');
    }
}
