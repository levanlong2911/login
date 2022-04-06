<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Login\CommentController;
use App\Http\Controllers\Login\PostController;
use App\Http\Controllers\Login\UserController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

/**
 * 
 * 
 */

Route::pattern('id', '[0-9]+');
Route::pattern('slug', '(.*)');


Route::prefix('user')->name('user.')->group(function(){
    Route::middleware(['guest:web','back'])->group(function(){
        Route::match(['get', 'post'], '/login', [UserController::class, 'login'])->name('login');
        Route::match(['get', 'post'], '/signup', [UserController::class, 'signup'])->name('signup');
        Route::match(['get', 'post'], '/login', [UserController::class, 'login'])->name('login');
        Route::get('/verify', [UserController::class, 'verify'])->name('verify');
        // Forgot password
        Route::match(['get', 'post'], '/password/forgot', [UserController::class, 'forgotPassword'])->name('forgot.password');
        Route::get('/password/reset/{token}', [UserController::class, 'showreset'])->name('reset.password.form');
        Route::post('/password/reset', [UserController::class, 'resetPassword'])->name('reset.password');
        
        
    });
    Route::middleware(['auth:web','verify_email', 'back'])->group(function(){
        Route::get('/list', [UserController::class, 'list'])->name('index');
        Route::post('/list', [UserController::class, 'search'])->name('search');
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
        Route::get('/del/{id}', [UserController::class, 'delUser'])->name('del');
        Route::match(['get', 'post'], '/edit/{id}', [UserController::class, 'editUser'])->name('edit');
        // post
        Route::get('/post',[PostController::class, 'index'])->name('post.index');
        Route::post('/post',[PostController::class, 'searchPost'])->name('post.search');
        Route::match(['get', 'post'], '/post/add',[PostController::class, 'addPost'])->name('post.add');
        Route::match(['get', 'post'], '/post/edit/{id}',[PostController::class, 'editPost'])->name('post.edit');
        Route::get('post/del/{id}', [PostController::class, 'delPost'])->name('post.del');
        // comment
        Route::get('/comment',[CommentController::class, 'index'])->name('comment.index');
        Route::post('/comment',[CommentController::class, 'searchComment'])->name('comment.search');
        Route::post('/comment',[CommentController::class, 'addComment'])->name('comment.add');
        Route::get('comment/del/{id}', [CommentController::class, 'delComment'])->name('comment.del');
    });
});
Route::prefix('/news')->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('news.index');
    Route::get('/{slug}-{id}.html', [HomeController::class, 'detail'])->name('news.detail');
});

