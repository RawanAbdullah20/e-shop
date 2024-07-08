<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;


Route::middleware(['redirectAdmin'])->prefix('admin')->group(
    function () {
        Route::get('login', [AdminAuthController::class, 'loginPage'])->name('admin.login');
        Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.post');
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    }

);


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');

    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');

    Route::post('/media', [ProductController::class, 'storeImage'])->name('admin.products.storeImage');

    Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');

    Route::get('/products/edit/{product_slug}', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::post('/products/delete/{product}', [ProductController::class, 'destroy'])->name('admin.products.delete');
});
