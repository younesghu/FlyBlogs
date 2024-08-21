<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\TwitterController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SocialMediaAccountController;

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

// Blog Routes
Route::get('/', [BlogController::class, 'index']);
Route::get('/about', function () { return view('about'); });
Route::get('/blogs/manage', [BlogController::class, 'manage'])->middleware('auth');
Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create')->middleware('auth');
Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store')->middleware('auth');
Route::get('/blogs/{blog}', [BlogController::class, 'show']);
Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit')->middleware('auth');
Route::put('/blogs/{blog}', [BlogController::class, 'update'])->middleware('auth');
Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->middleware('auth');

// Comments Routes
Route::post('/blogs/{blog}', [CommentController::class, 'store'])->middleware('auth');
Route::put('/blogs/{blog}/comments/{comment}', [CommentController::class, 'update'])->name('comments.update')->middleware('auth');
Route::delete('/blogs/{blog}/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy')->middleware('auth');

// Blog likes Routes
Route::post('/blogs/{blog}/like', [BlogController::class, 'like'])->middleware('auth');
Route::post('/blogs/{blog}/unlike', [BlogController::class, 'unlike'])->middleware('auth');

// Social Media Accounts Routes
Route::get('/accounts', [SocialMediaAccountController::class, 'index'])->name('media.index')->middleware('auth');

// Twitter Routes
Route::get('auth/twitter', [TwitterController::class, 'redirectToTwitter'])->name('twitter.redirect')->middleware('auth');
Route::get('auth/twitter/callback',  [TwitterController::class, 'handleTwitterCallback'])->name('twitter.callback')->middleware('auth');
Route::delete('/twitter-destroy', [TwitterController::class, 'destroy'])->name('twitter.destroy')->middleware('auth');

// Notifications
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index')->middleware('auth');

// User Routes
Route::post('/users', [UserController::class, 'store']);
Route::put('/user/update', [UserController::class, 'updateProfile'])->name('user.update')->middleware('auth');
Route::put('/password/update', [UserController::class, 'resetPassword'])->name('password.update')->middleware('auth');
Route::get('/users/settings', [UserController::class, 'edit'])->middleware('auth');

Route::get('/register', [UserController::class, 'create']);
Route::post('/users/authentificate', [UserController::class, 'authentificate']);
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout']);
