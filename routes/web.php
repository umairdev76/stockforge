<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/',function(){
    return view('auth.login');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // users
    Route::get('users',[UserController::class,'index'])->name('user.index');
    Route::get('users/create',[UserController::class,'create'])->name('user.create');
    Route::post('users/store',[UserController::class,'store'])->name('user.store');
    Route::get('user/{user}/edit',[UserController::class,'edit'])->name('user.edit');
    Route::put('user/{user}/update',[UserController::class,'update'])->name('user.update');
    Route::delete('user/{user}/destroy',[UserController::class,'destroy'])->name('user.destroy');

    // products
    Route::get('products',[ProductController::class,'index'])->name('product.index');
    Route::get('product/create',[ProductController::class,'create'])->name('product.create');
    Route::post('product/store',[ProductController::class,'store'])->name('product.store');
    Route::get('product/{product}/show',[ProductController::class,'show'])->name('product.show');
    Route::get('product/{product}/edit',[ProductController::class,'edit'])->name('product.edit');
    Route::put('product/{product}/update',[ProductController::class,'update'])->name('product.update');
    Route::delete('product/{product}/destroy',[ProductController::class,'destroy'])->name('product.destroy');

    // category
    Route::get('categories',[CategoryController::class,'index'])->name('category.index');
    Route::get('category/create',[CategoryController::class,'create'])->name('category.create');
    Route::post('category/store',[CategoryController::class,'store'])->name('category.store');
    Route::get('category/{category}/edit',[CategoryController::class,'edit'])->name('category.edit');
    Route::put('category/{category}/update',[CategoryController::class,'update'])->name('category.update');
    Route::delete('category/{category}/destroy',[CategoryController::class,'destroy'])->name('category.destroy');

    // supplier
    Route::get('suppliers',[SupplierController::class,'index'])->name('supplier.index');
    Route::get('supplier/create',[SupplierController::class,'create'])->name('supplier.create');
    Route::post('supplier/store',[SupplierController::class,'store'])->name('supplier.store');
    Route::get('supplier/{supplier}/edit',[SupplierController::class,'edit'])->name('supplier.edit');
    Route::put('supplier/{supplier}/update',[SupplierController::class,'update'])->name('supplier.update');
    Route::delete('supplier/{supplier}/destroy',[SupplierController::class,'destroy'])->name('supplier.destroy');

    // purchase order
    Route::get('purchase-orders',[PurchaseOrderController::class,'index'])->name('purchaseOrder.index');
    Route::get('purchase-order/create',[PurchaseOrderController::class,'create'])->name('purchaseOrder.create');
    Route::post('purchase-order/store',[PurchaseOrderController::class,'store'])->name('purchaseOrder.store');
    Route::get('purchase-order/{purchaseOrder}/show',[PurchaseOrderController::class,'show'])->name('purchaseOrder.show');
});

require __DIR__.'/auth.php';
