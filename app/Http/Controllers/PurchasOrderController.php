<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\StockMoveMent;
use App\Models\Supplier;
use App\Models\WareHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PurchasOrderController extends Controller
{
    //
   public function index()
{
    // Ambil purchase orders beserta supplier & items → fix N+1
    $orders = PurchaseOrder::with(['supplier', 'items.material'])
        ->withCount('items') // otomatis buat field items_count
        ->paginate(10);

    // Ambil semua warehouse untuk opsi di modal
    $warehouses = WareHouse::all();

    $role = auth()->user()->role->name;

    switch ($role) {
        case 'admin':
            return view('admin.purchase_orders.index', compact('orders'));
        case 'staff':
            return view('staff.purchase_orders.index', compact('orders', 'warehouses'));
        default:
            abort(403, 'Unauthorized');
    }
}

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|uuid|exists:suppliers,id',
            'order_date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.material_id' => 'required|uuid|exists:materials,id',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.unit' => 'nullable|string|min:2',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            $po = PurchaseOrder::create([
                'id' => \Str::uuid(),
                'created_by' => Auth::id(),
                'supplier_id' => $request->supplier_id,
                'order_date' => $request->order_date,
                'status' => 'pending',
            ]);

            foreach ($request->items as $item) {
                Log::info('Creating PurchaseOrderItem:', $item);
                PurchaseOrderItem::create([
                    'id' => \Str::uuid(),
                    'purchase_order_id' => $po->id,
                    'material_id' => $item['material_id'],
                    'quantity' => $item['quantity'],
                    'unit' => $item['unit'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $item['quantity'] * $item['unit_price'],
                ]);
            }
        });

        return redirect()->route('staff.purchase_orders.index')->with('Purchase Order Has Been Created!');
    }

    public function create()
    {
        $suppliers = Supplier::get();
        $materials = Material::get();
        return view('staff.purchase_orders.create', compact('suppliers', 'materials'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,received,canceled',
        ]);

        $order = PurchaseOrder::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->route('purchase_orders.index')->with('success', 'Status berhasil diupdate.');
    }

    public function edit($id)
    {
            $order = PurchaseOrder::with(['supplier', 'items'])->findOrFail($id);
            $materials = Material::all(); // supaya dropdown material bisa muncul

            return view('staff.purchase_orders.edit', compact('order', 'materials'));

    }

    public function show($id)
    {
        $order = PurchaseOrder::with(['supplier', 'items.material'])->findOrFail($id);

        return view('staff.purchase_orders.show', compact('order'));
    }


        /**
     * Update draft PO (only if pending)
     */
    public function update(Request $request, $id)
    {
        $po = PurchaseOrder::where('id', $id)->where('status', 'pending')->firstOrFail();

        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.material_id' => 'required|uuid|exists:materials,id',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.unit' => 'nullable|string|min:2',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request, $po) {
            // Hapus item lama
            $po->items()->delete();

            // Tambahkan item baru
            foreach ($request->items as $item) {
                Log::info('Creating PurchaseOrderItem:', $item);
                PurchaseOrderItem::create([
                    'id' => \Str::uuid(),
                    'purchase_order_id' => $po->id,
                    'material_id' => $item['material_id'],
                    'quantity' => $item['quantity'],
                    'unit' => $item['unit'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $item['quantity'] * $item['unit_price'],
                ]);
            }
        });

        return redirect()->route('staff.purchase_orders.index')->with('Purchase Order updated successfully');
    }

    /**
     * Mark PO as received (update stock)
     */
    public function markAsReceived($id)
    {
        DB::transaction(function () use ($id) {
        $po = PurchaseOrder::with('items')
            ->where('id', $id)
            ->where('status', 'pending')
            ->lockForUpdate()
            ->firstOrFail();

        // Update status ke received
        $po->update([
            'status'       => 'received',
            'received_by'  => auth()->id(),
            'received_at'  => now(),
        ]);

        foreach ($po->items as $item) {
            $material = Material::findOrFail($item->material_id);

            // Tambah stok
            $material->increment('stock', $item->quantity);

            // Catat stock movement (IN)
            StockMoveMent::create([
                'material_id'    => $item->material_id,
                'quantity'       => $item->quantity,
                'type'           => 'in',
                'reference' => 'purchase_orders',
                'created_by'     => auth()->id(),
            ]);
        }
    });

    return redirect()->route('staff.purchase_orders.index')
        ->with('success', 'Purchase Order received & stock updated');
    }

    public function unreceive($id)
{
   DB::transaction(function () use ($id) {
        $po = PurchaseOrder::with('items')
            ->where('id', $id)
            ->where('status', 'received')
            ->lockForUpdate()
            ->firstOrFail();

        // Update status ke pending
        $po->update([
            'status'         => 'pending',
            'unreceived_by'  => auth()->id(),
            'unreceived_at'  => now(),
        ]);

        foreach ($po->items as $item) {
            $material = Material::findOrFail($item->material_id);

            // Validasi agar stok tidak minus
            if ($material->stock < $item->quantity) {
                throw new \Exception("Stock untuk {$material->name} tidak cukup untuk rollback.");
            }

            // Kurangi stok
            $material->decrement('stock', $item->quantity);

            // Catat stock movement (OUT / rollback)
            StockMovement::create([
                'material_id'    => $item->material_id,
                'quantity'       => -$item->quantity,
                'type'           => 'out',
                'reference' => 'purchase_orders',
                'created_by'     => auth()->id(),
            ]);
        }
    });

    return redirect()->route('staff.purchase_orders.index')
        ->with('success', 'Purchase Order unreceived & stock rolled back');
}


    /**
     * Delete draft PO
     */
    public function destroy($id)
    {
        $po = PurchaseOrder::where('id', $id)->where('status', 'pending')->firstOrFail();
        $po->delete();

        return redirect()->route('staff.purchase_orders.index')->with('Purchase Order deleted successfully');
    }
}
