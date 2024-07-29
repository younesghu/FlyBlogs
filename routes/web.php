<?php

use App\Models\Blog;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use Laravel\Socialite\Facades\Socialite;
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

// Route::get('/', function () {
//     return view('main');
// });
// Route::post('/register', [UserController::class, 'register']);
// Route::get('/login', [UserController::class, 'login']);
// Route::post('/authentificate', [UserController::class, 'authentificate']);
// Route::post('/logout', [UserController::class, 'logout']);


// Blog Routes
Route::get('/', [BlogController::class, 'index']);
Route::get('/blogs/manage', [BlogController::class, 'manage']);
Route::get('/blogs/create', [BlogController::class, 'create']);
Route::post('/blogs', [BlogController::class, 'store']);
Route::get('/blogs/{blog}', [BlogController::class, 'show']);
Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
Route::put('/blogs/{blog}', [BlogController::class, 'update']);
Route::delete('/blogs/{blog}', [BlogController::class, 'destroy']);

// Comments Routes
Route::post('/blogs/{blog}', [CommentController::class, 'store'])->middleware('auth');

Route::put('/blogs/{blog}/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/blogs/{blog}/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

// Blog likes
Route::post('/blogs/{blog}/like', [BlogController::class, 'like']);
Route::post('/blogs/{blog}/unlike', [BlogController::class, 'unlike']);

// Social Media Accounts Routes
Route::get('/accounts', [SocialMediaAccountController::class, 'index'])->name('media.index');

// Twitter Routes
Route::get('auth/twitter', [TwitterController::class, 'redirectToTwitter'])->name('auth.twitter');
Route::get('auth/twitter/callback',  [TwitterController::class, 'handleTwitterCallback']);

Route::get('test-twitter', function() {
    try {
        return Socialite::driver('twitter')->redirect();
    } catch (\Exception $e) {
        Log::error('Error in test redirect: ' . $e->getMessage());
        return 'Failed to redirect: ' . $e->getMessage();
    }
});

// Notifications
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

// User Routes
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/settings', [UserController::class, 'update'])->name('users.update');
Route::get('/users/settings', [UserController::class, 'edit']);

Route::get('/register', [UserController::class, 'create']);
Route::post('/users/authentificate', [UserController::class, 'authentificate']);
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout']);
