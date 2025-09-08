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

}
