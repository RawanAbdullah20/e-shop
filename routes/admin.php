<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
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
    //media
    Route::prefix('media')->group(function () {

        Route::post('/', [MediaController::class, 'storeImage'])->name('admin.media.storeImage');

        Route::delete('/delete/{id}', [MediaController::class, 'destroy'])->name('admin.media.delete');
    });
    //brands
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/edit/{product_slug}', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::post('/update/{product}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/delete/{product}', [ProductController::class, 'destroy'])->name('admin.products.delete');
    });
    //category
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::post('/store', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::post('/update/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.delete');
    });
    //brands
    Route::prefix('brands')->group(function () {
        Route::get('/', [BrandController::class, 'index'])->name('admin.brands.index');
        Route::post('/store', [BrandController::class, 'store'])->name('admin.brands.store');
        Route::post('/update/{brand}', [BrandController::class, 'update'])->name('admin.brands.update');
        Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])->name('admin.brands.delete');
    });

    //users
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
        Route::post('/store', [UserController::class, 'store'])->name('admin.users.store');
        Route::put('/update/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/delete/{user}', [UserController::class, 'destroy'])->name('admin.users.delete');
    });
});