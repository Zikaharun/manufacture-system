<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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

});

require __DIR__.'/auth.php';
