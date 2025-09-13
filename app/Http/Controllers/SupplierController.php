<?php

namespace App\Http\Controllers;

use App\Services\SupplierService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{
    //
    protected SupplierService $supplierService;
    
    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function index(Request $request)
    {
        $search = $request->query('search', '');
        Log::info('Search query: ' . $search); // Log the search query

        $suppliers = $this->supplierService->get($search);

        $role = auth()->user()->role->name;

        switch ($role) {
            case 'admin' :
                 return view('admin.suppliers.index', compact('suppliers', 'search'));
            case 'staff' :
                return view('staff.suppliers.index', compact('suppliers', 'search'));
            default:
            abort(403, 'Unauthorized');
        }

    }

    public function create(Request $request)
    {
        return view('admin.suppliers.create');
    }

    public function store( Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255'
        ]);

        $this->supplierService->create($data);
        return redirect()->route('suppliers.index')->with('success', 'Suppliers has been added!');
    }

    public function edit($id)
    {
        $suppliers = $this->supplierService->findById($id);
        return view('admin.suppliers.edit', compact('suppliers'));
    }

    public function update (Request $request, $id)
    {
         $data = $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255'
        ]);

        $this->supplierService->update($id, $data);
        return redirect()->route('suppliers.index')->with('success', 'supliers has been updated!');
    }

    public function destroy($id)
    {
        $this->supplierService->delete($id);
        return redirect()->route('suppliers.index')->with('success','supliers has been deleted!');
    }
}
