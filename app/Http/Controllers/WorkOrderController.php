<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WorkOrderController extends Controller
{
    //
    public function index()
    {
        $workOrders = WorkOrder::with('product', 'creator')->latest()->get();

        return view('admin.work_orders.index', compact('workOrders'));
    }

    public function create()
    {
        $products = Product::get();

        return view('admin.work_orders.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'planned_start_date' => 'nullable|date',
            'planned_end_date' => 'nullable|date|after_or_equal:planned_start_date',

        ]);

        WorkOrder::create([
            'id' => Str::uuid(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'status' => 'planned',
            'planned_start_date' => $request->planned_start_date,
            'planned_end_date' => $request->planned_end_date,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('work_orders.index')->with('success', 'Work order berhasil dibuat!');
    }

        /**
     * Form edit Work Order.
     */
    public function edit($id)
    {
        // ✅ load relasi product & creator supaya tidak N+1
        $workOrder = WorkOrder::with(['product', 'creator'])->findOrFail($id);
        $products = Product::all();

        return view('admin.work_orders.edit', compact('workOrder', 'products'));
    }

    /**
     * Update Work Order.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'planned_start_date' => 'nullable|date',
            'planned_end_date' => 'nullable|date|after_or_equal:planned_start_date',
            'status' => 'required|in:planned,in_progress,completed,canceled',
        ]);

        $workOrder = WorkOrder::with(['product', 'creator'])->findOrFail($id);

        $workOrder->update([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'planned_start_date' => $request->planned_start_date,
            'planned_end_date' => $request->planned_end_date,
            'status' => $request->status,
        ]);

        return redirect()->route('work_orders.index')->with('success', 'Work Order berhasil diperbarui!');
    }

    /**
     * Hapus Work Order.
     */
    public function destroy($id)
    {
        $workOrder = WorkOrder::with(['product', 'creator'])->findOrFail($id);
        $workOrder->delete();

        return redirect()->route('work_orders.index')->with('success', 'Work Order berhasil dihapus!');
    }

      /**
     * Approve (ubah status ke in_progress)
     */
    public function approve($id)
    {
        $workOrder = WorkOrder::findOrFail($id);

        if ($workOrder->status !== 'planned') {
            return redirect()->back()->with('error', 'Work order tidak bisa di-approve.');
        }

        $workOrder->update(['status' => 'in_progress']);

        return redirect()->route('admin.work_orders.index')->with('success', 'Work order berhasil di-approve!');
    }

    /**
     * Complete Work Order
     */
    public function complete($id)
    {
        $workOrder = WorkOrder::findOrFail($id);

        if ($workOrder->status !== 'in_progress') {
            return redirect()->back()->with('error', 'Work order tidak bisa diselesaikan.');
        }

        $workOrder->update(['status' => 'completed']);

        return redirect()->route('admin.work_orders.index')->with('success', 'Work order selesai!');
    }

    /**
     * Cancel Work Order
     */
    public function cancel($id)
    {
        $workOrder = WorkOrder::findOrFail($id);

        if (in_array($workOrder->status, ['completed', 'canceled'])) {
            return redirect()->back()->with('error', 'Work order tidak bisa dibatalkan.');
        }

        $workOrder->update(['status' => 'canceled']);

        return redirect()->route('admin.work_orders.index')->with('success', 'Work order dibatalkan!');
    }


}
