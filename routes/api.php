<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;

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


Route::get('/blog', [BlogController::class, 'index']);
Route::post('/create', [BlogController::class, 'createBlog']);
Route::put('/edit/{id}', [BlogController::class, 'editBlog']);
Route::delete('/delete/{id}', [BlogController::class, 'deleteBlog']);


// category route
Route::get('/category', [CategoryController::class, 'getCategory']);
Route::post('/category', [CategoryController::class, 'createCategory']);
Route::put('/category/{id}', [CategoryController::class, 'editCategory']);
Route::delete('/category/{id}', [CategoryController::class, 'deleteCategory']);


// tag route
Route::get('/tag', [TagController::class, 'getTag']);
Route::post('/tag', [TagController::class, 'createTag']);
