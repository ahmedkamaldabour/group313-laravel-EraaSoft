<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', fn(Request $request) => $request->user());

Route::post('login' , [LoginController::class , 'login'])->name('login');
Route::post('logout' , [LoginController::class , 'logout'])->middleware('auth:sanctum');

Route::get('/admin/products/index', [ProductController::class, 'index']);
Route::post('/admin/products/store', [ProductController::class, 'store']);
Route::post('/admin/products/update/{product}', [ProductController::class, 'update']);
Route::post('/admin/products/destroy/{product}', [ProductController::class, 'destroy']);

Route::get('/admin/category/index', [CategoryController::class, 'index']);
Route::post('/admin/category/store', [CategoryController::class, 'store'])->middleware('auth:sanctum');
Route::post('/admin/category/update/{category}', [CategoryController::class, 'update']);
Route::post('/admin/category/destroy/{id}', [CategoryController::class, 'destroy']);

