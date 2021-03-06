<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\HomeFeedController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserFollowController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/',[HomeFeedController::class, 'index'])->name('home');

Route::get('/',function () {
    return view('home');
})->name('home');

Route::get('/users/{user:username}/posts',[UserPostController::class, 'index'])->name('users.posts');

Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::post('/logout',[LogoutController::class, 'store'])->name('logout');

Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::post('/login',[LoginController::class, 'store']);

Route::get('/register',[RegisterController::class, 'index'])->name('register');
Route::post('/register',[RegisterController::class, 'store']);

Route::get('/people',[PeopleController::class, 'index'])->name('people');
Route::post('/people',[PeopleController::class, 'show'])->name('people.search');

Route::get('/posts',[PostController::class, 'index'])->name('posts');
Route::get('/posts/{post}',[PostController::class, 'show'])->name('posts.show');
Route::post('/posts',[PostController::class, 'store']);
Route::delete('/posts/{post}',[PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/posts/{post}/likes',[PostLikeController::class, 'store'])->name('posts.likes');
Route::delete('/posts/{post}/likes',[PostLikeController::class, 'destroy'])->name('posts.likes');

Route::post('/posts/{post}/comments',[PostCommentController::class, 'store'])->name('posts.comments');
Route::delete('/posts/comments/{comment}',[PostCommentController::class, 'destroy'])->name('comments.destroy');

Route::get('/users/{user:username}/followers',[UserFollowController::class, 'index'])->name('users.followers');
Route::post('/users/{user:id}/follow',[UserFollowController::class, 'store'])->name('users.follows');
Route::delete('/users/{user:id}/follow',[UserFollowController::class, 'destroy'])->name('users.unfollows');

Route::put('/user/update',[UserController::class, 'update'])->name('user.update');
