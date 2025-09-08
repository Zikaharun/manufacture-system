<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\StockMoveMent;
use Illuminate\Http\Request;

class StockMovementController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = StockMoveMent::with(['material', 'warehouse', 'creator'])
            ->orderBy('created_at', 'desc');

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('material_id')) {
            $query->where('material_id', $request->material_id);
        }

        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
        }

        $movements = $query->paginate(20);
        $materials = Material::all();

        return view('admin.stock_movements.index', compact('movements', 'materials'));
    }

    /**
     * Tampilkan detail 1 stock movement.
     */
    public function show($id)
    {
        $movement = StockMovement::with(['material', 'warehouse', 'creator'])
            ->findOrFail($id);

        return view('admin.stock_movements.show', compact('movement'));
    }
}
