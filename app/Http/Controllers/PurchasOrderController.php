<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class PurchasOrderController extends Controller
{
    //
    public function index()
    {
        $orders = PurchaseOrder::with('supplier')->paginate(10);
        return view('admin.purchase_orders.index', compact('orders'));
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
}
