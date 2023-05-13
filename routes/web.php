<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



// Route::get('url',[controller,action])
Route::get('/',[HomeController::class,'home']);
Route::get('/about/{id?}',[HomeController::class,'about']);

// Categories Routes
Route::get('/categories',[CategoryController::class,'index']);
Route::get('/categories/create',[CategoryController::class,'create']);
Route::post('/categories',[CategoryController::class,'store']);
Route::get('/categories/{id}/edit',[CategoryController::class,'edit']);
Route::put('/categories/{id}',[CategoryController::class,'update']);
Route::delete('/categories/delete/{id}',[CategoryController::class,'destroy']);









// table ==> categories (id,name)
// migration ==> create_categories_table done
// model ==> Category done
// controller ==> CategoryController done


// fake data (seeder) and (factory)









// route
// make controller
// how to make controller == > php artisan make:controller ControllerName
// inside controller create method ( action )
// return view welcome in it
// go to modify route



// Every Table in DB has a model and a Migration file
// db => students
// model => Student
// migration file => create_students_table
// create Controller => StudentController



// PSR
