<?php

use App\Http\Controllers\productController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

route::get('/listproduct', [productController::class, 'productView']);
route::get('/listmaster', [productController::class, 'productMasterlist'])->name('product.list');
route::post('/product/add', [productController::class,'addProduct'])->name('product.add');
route::get('/product/edit/{index}', [productController::class, 'editProduct'])->name('product.edit');
route::post('/product/update/{index}', [productController::class, 'updateProduct'])->name('product.update');
route::delete('/product/delete/{index}', [productController::class, 'deleteProduct'])->name('product.delete');
