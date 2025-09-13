<?php

namespace App\Http\Controllers;

use App\Models\ProductionLog;
use App\Models\StockMoveMent;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        'work_order_id'    => 'required|uuid',
        'quantity_produced'=> 'required|integer|min:1',
        'reject_quantity'  => 'nullable|integer|min:0',
        'production_date'  => 'required|date',
    ]);

    // 1. Simpan production log
    $log = ProductionLog::create([
        'id'               => Str::uuid(),
        'user_id'          => Auth::id(),
        'work_order_id'    => $request->work_order_id,
        'quantity_produced'=> $request->quantity_produced,
        'reject_quantity'  => $request->reject_quantity ?? 0,
        'production_date'  => $request->production_date,
    ]);

    // 2. Ambil work order
    $workOrder = WorkOrder::findOrFail($request->work_order_id);

    // 3. Hitung produk bagus
    $goodQty = $request->quantity_produced - ($request->reject_quantity ?? 0);

    // 4. Update stok product
    if ($workOrder->product && $goodQty > 0) {
        $workOrder->product->increment('stock', $goodQty);

        // 5. Catat ke stock_movements (type in)
        StockMoveMent::create([
            'id'          => Str::uuid(),
            'product_id' => $workOrder->product_id, // atau pakai product_id kalau kolomnya begitu
            'warehouse_id' => '019940ff-bdd6-73cb-9a3c-afe8b07ce6ef',
            'quantity'    => $goodQty,
            'type'        => 'in',
            'reference'   => 'ProductionLog: ' . $log->workOrder->wo_code, // untuk tracking balik ke log
            'created_by'  => Auth::id(),
        ]);
    }

    return redirect()
        ->route('staff.work_orders.index')
        ->with('success', 'Production log recorded, stock updated, and movement logged.');
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
        $workOrderId = $productionLog->work_order_id;

        $productionLog->delete();

        return redirect()->route('staff.work_orders.show', $workOrderId)->with('success', 'Production log deleted.');
    }
}
