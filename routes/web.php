<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;


// Dashboard And login Routes
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'guest',
],function (){
    Route::get('/login', [LoginController::class, 'loginPage'])->name('loginPage');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

});



Route::group(
    [
        'prefix' => 'admin',
        'middleware' => 'IsAdmin',
    ],
    function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin');
        Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
        Route::group([
            'prefix' => 'products', // url: /admin/products
            'as' => 'products.', // route name: admin.products.index
        ], function () {
            Route::get('index', [ProductController::class, 'index'])->name('index');
            Route::get('create', [ProductController::class, 'create'])->name('create');
            Route::get('edit{id}', [ProductController::class, 'edit'])->name('edit');
            Route::post('store', [ProductController::class, 'store'])->name('store');
        });
        Route::group([
            'prefix' => 'categories',
            'as' => 'categories.',
        ], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/', [CategoryController::class, 'store'])->name('store');
            Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
            Route::put('/{id}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/delete/{category}', [CategoryController::class, 'destroy'])->name('destroy');
        });
    });
