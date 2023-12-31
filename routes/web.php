<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Blog;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!la
|
*/

// Route::get('/', function () {
//     return view('main');
// });
// Route::post('/register', [UserController::class, 'register']);
// Route::get('/login', [UserController::class, 'login']);
// Route::post('/authentificate', [UserController::class, 'authentificate']);
// Route::post('/logout', [UserController::class, 'logout']);


// Blog Routes

// Route::post('/store', [BlogController::class, 'createBlog']);
Route::get('/', [BlogController::class, 'index']);
Route::get('/blogs/create', [BlogController::class, 'create']);
Route::post('/blogs', [BlogController::class, 'store']);
Route::get('/blogs/{blog}', [BlogController::class, 'show']);

Route::post('/blogs/{blog}', [CommentController::class, 'store']);


// User Routes
// Route::resource('users', UserController::class)
//     ->only()
Route::post('/users', [UserController::class, 'store']);
Route::get('/users', [UserController::class, 'edit'])->name('users.edit');

Route::get('/register', [UserController::class, 'create']);
Route::post('/users/authentificate', [UserController::class, 'authentificate']);
Route::get('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

// Comments Routes

// Route::get('/blogs/{blog}/comments', [CommentController::class, 'show']);
