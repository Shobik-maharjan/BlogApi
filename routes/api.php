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
Route::get('/blog/{id}', [BlogController::class, 'getSingleBlog']);
Route::post('/create/blog', [BlogController::class, 'createBlog']);
Route::put('/edit/blog/{id}', [BlogController::class, 'editBlog']);
Route::delete('/delete/blog/{id}', [BlogController::class, 'deleteBlog']);

Route::post('/add/image/{id}', [BlogController::class, 'addImage']);


// category route
Route::get('/category', [CategoryController::class, 'getCategory']);
Route::post('/create/category', [CategoryController::class, 'createCategory']);
Route::put('/edit/category/{id}', [CategoryController::class, 'editCategory']);
Route::delete('/delete/category/{id}', [CategoryController::class, 'deleteCategory']);


// tag route
Route::get('/tag', [TagController::class, 'getTag']);
Route::post('/create/tag', [TagController::class, 'createTag']);
Route::put('/edit/tag/{id}', [TagController::class, 'editTag']);
Route::delete('/delete/tag/{id}', [TagController::class, 'deleteTag']);
