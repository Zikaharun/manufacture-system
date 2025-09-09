<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BillOfMaterialController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialUsageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductionLogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchasOrderController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\WareHouseController;
use App\Http\Controllers\WorkOrderController;
use App\Models\Supplier;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::prefix('Admin')->middleware(['auth','verified','role:admin'])->group(function () {
    Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// list products
Route::get('/products', [ProductController::class,'index'])->name('products.index');

// create form
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
// store new product
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// show detail product
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// edit form
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
// update product
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

// delete product
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');


Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');
Route::get('/materials/create', [MaterialController::class, 'create'])->name('materials.create');
Route::post('/materials', [MaterialController::class, 'store'])->name('materials.store');
Route::get('/materials/{material}', [MaterialController::class, 'show'])->name('materials.show');
Route::get('/materials/{material}/edit', [MaterialController::class, 'edit'])->name('materials.edit');
Route::put('/materials/{material}', [MaterialController::class, 'update'])->name('materials.update');
Route::delete('/materials/{material}', [MaterialController::class, 'destroy'])->name('materials.destroy');

Route::get('/boms', [BillOfMaterialController::class, 'index'])->name('boms.index');

Route::get('/boms/create', [BillOfMaterialController::class, 'create'])->name('boms.create');

Route::post('/boms', [BillOfMaterialController::class, 'store'])->name('boms.store');
Route::get('/boms/{id}/edit', [BillOfMaterialController::class, 'edit'])->name('boms.edit');
// Route::get('/boms/{productId}/edit', [BillOfMaterialController::class, 'updateMaterialsInBoms'])->name('boms.edit_materials');

Route::put('/boms/{id}', [BillOfMaterialController::class, 'update'])->name('boms.update');
// Route::put('/boms/{product}/{material}', [BillOfMaterialController::class, 'updateMaterialsByProductId'])->name('materials_in_boms.update');
Route::get('/boms/{productId}', [BillOfMaterialController::class, 'showByProduct'])->name('boms.detail');
Route::delete('/boms/{id}', [BillOfMaterialController::class, 'destroy'])->name('boms.destroy');

Route::get('/warehouses', [WareHouseController::class, 'index'])->name('warehouses.index');
Route::get('/warehouses/create', [WareHouseController::class, 'create'])->name('warehouses.create');
Route::post('/warehouses', [WareHouseController::class, 'store'])->name('warehouse.store');
Route::get('/warehouses/{id}/edit', [WareHouseController::class, 'edit'])->name('warehouse.edit');
Route::put('/warehouses/{id}', [WareHouseController::class, 'update'])->name('warehouse.update');
Route::delete('/warehouses/{id}', [WareHouseController::class, 'destroy'])->name('warehouse.destroy');

Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
Route::get('/suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
Route::get('/suppliers/{id}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
Route::put('/suppliers/{id}', [SupplierController::class, 'update'])->name('suppliers.update');
Route::delete('/suppliers/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

 Route::get('/purchase-orders', [PurchasOrderController::class, 'index'])->name('purchase_orders.index');
 Route::patch('/purchase-orders/{id}/status', [PurchasOrderController::class, 'updateStatus'])->name('purchase_orders.updateStatus');


 Route::get('/work_orders', [WorkOrderController::class, 'index'])->name('work_orders.index');
 Route::get('/purchase_orders/create', [WorkOrderController::class, 'create'])->name('work_orders.create');
 Route::post('/work_orders', [WorkOrderController::class, 'store'])->name('work_orders.store');
 Route::get('/work_orders/{id}/edit', [WorkOrderController::class, 'edit'])->name('work_orders.edit');
 Route::put('/work_orders/{id}', [WorkOrderController::class, 'update'])->name('work_orders.update');
 Route::delete('/work_orders/{id}', [WorkOrderController::class, 'destroy'])->name('work_orders.destroy');
 Route::patch('/work_orders/{id}/approve', [WorkOrderController::class, 'approve'])->name('work_orders.approve');
 Route::patch('/work_orders/{id}/complete', [WorkOrderController::class, 'complete'])->name('work_orders.complete');
 Route::patch('/work_orders/{id}/cancel', [WorkOrderController::class, 'cancel'])->name('work_orders.cancel');


 Route::get('/stock_movements', [StockMovementController::class, 'index'])->name('stock_movements.index');
 Route::get('/stock_movements/{id}', [StockMovementController::class, 'show'])->name('stock_movements.show');

 Route::get('/material_usages', [MaterialUsageController::class, 'index'])->name('material_usages.index');
 Route::get('/material_usages/{id}', [MaterialUsageController::class, 'show'])->name('material_usages.show');

 Route::get('/production_logs', [ProductionLogController::class, 'index'])->name('production_logs.index');
 Route::get('/production_logs/{id}', [ProductionLogController::class, 'show'])->name('production_logs.show');

});

// for staff

Route::prefix('staff')->name('staff.')->group(function () {
    // Register Staff
    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    // Login Staff
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    // Logout Staff
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

Route::middleware(['auth','verified', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', function () {
        return view('staff.dashboard');
    })->name('dashboard');
});


require __DIR__.'/auth.php';
