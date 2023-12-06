<?php

use App\Http\Controllers\BlogController;
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
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('main');
// });
// Route::post('/register', [UserController::class, 'register']);
// Route::get('/login', [UserController::class, 'login']);
// Route::post('/authentificate', [UserController::class, 'authentificate']);
// Route::post('/logout', [UserController::class, 'logout']);

Route::post('/users', [UserController::class, 'store']);
Route::get('/register', [UserController::class, 'create']);
Route::get('/login', [UserController::class, 'login']);

// Route::post('/store', [BlogController::class, 'createBlog']);
Route::get('/', [BlogController::class, 'index']);

Route::get('/blogs/{blog}', [BlogController::class, 'show']);
Route::get('/blogs/create', [BlogController::class, 'create']);
