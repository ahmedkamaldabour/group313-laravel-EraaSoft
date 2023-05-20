<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;



// Dashboard And login Routes
Route::get('/admin',[DashboardController::class,'index']);
Route::get('/admin/login',[DashboardController::class,'loginPage']);

// Categories Routes
Route::get('admin/categories',[CategoryController::class,'index']);
Route::get('admin/categories/create',[CategoryController::class,'create']);
Route::post('admin/categories',[CategoryController::class,'store']);
Route::get('admin/categories/{category}/edit',[CategoryController::class,'edit']);
Route::put('admin/categories/{id}',[CategoryController::class,'update']);
Route::delete('admin/categories/delete/{category}',[CategoryController::class,'destroy']);


// products Routes
Route::get('admin/products/index',[ProductController::class,'index'])->name('products.index');
Route::get('admin/products/create/',[ProductController::class,'create'])->name('products.create');
Route::post('admin/products/store',[ProductController::class,'store'])->name('products.store');
