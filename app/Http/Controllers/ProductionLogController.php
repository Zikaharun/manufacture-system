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
        $logs = ProductionLog::with(['workOrder', 'user'])
            ->latest()
            ->paginate(20);

        return view('admin.production_logs.index', compact('logs'));
    }

    // Menampilkan detail produksi
    public function show($id)
    {
        $log = ProductionLog::with(['workOrder', 'user'])
            ->findOrFail($id);

        return view('admin.production_logs.show', compact('log'));
    }
}
