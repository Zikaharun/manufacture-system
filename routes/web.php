<?php

use App\Http\Controllers\BillOfMaterialController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchasOrderController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\WareHouseController;
use App\Models\Supplier;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
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

});

require __DIR__.'/auth.php';
