<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('url',[controller,action])
Route::get('/home',[HomeController::class,'home']);
Route::get('/about/{id?}',[HomeController::class,'about']);



// route
// make controller
// how to make controller == > php artisan make:controller ControllerName
// inside controller create method ( action )
// return view welcome in it
// go to modify route
