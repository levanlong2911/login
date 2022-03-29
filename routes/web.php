<?php

use App\Http\Controllers\Login\UserController;
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
 * PreventBackHistory: tạo middleware và chức năng ngăn người dùng back lại trang cũ khi đã đăng xuất
 * cách trình bày/
 * dùng try catch
 * đặt lại tên middleware/
 * onclick="return confirm('削除しませんか')" trước khi xóa
 */




Route::prefix('user')->name('user.')->group(function(){
    Route::middleware(['guest:web','back'])->group(function(){
        // Route::get('/login', [UserController::class, 'loginUser'])->name('login');
        // Route::post('/check', [UserController::class, 'check'])->name('check');
        Route::match(['get', 'post'], '/login', [UserController::class, 'login'])->name('login');
        Route::match(['get', 'post'], '/signup', [UserController::class, 'signup'])->name('signup');
        // Route::get('/signup', [UserController::class, 'signup'])->name('signup');
        // Route::post('/create', [UserController::class, 'create'])->name('create');
        Route::match(['get', 'post'], '/login', [UserController::class, 'login'])->name('login');
        Route::get('/verify', [UserController::class, 'verify'])->name('verify');
        // Forgot password
        // Route::get('/password/forgot', [UserController::class, 'showForgot'])->name('forgot.password');
        // Route::post('/password/forgot', [UserController::class, 'sendLink'])->name('forgot.link');
        Route::match(['get', 'post'], '/password/forgot', [UserController::class, 'forgotPassword'])->name('forgot.password');
        Route::get('/password/reset/{token}', [UserController::class, 'showreset'])->name('reset.password.form');
        Route::post('/password/reset', [UserController::class, 'resetPassword'])->name('reset.password');
        
    });
    Route::middleware(['auth:web','verify_email', 'back'])->group(function(){
        Route::get('/list', [UserController::class, 'list'])->name('index');
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
        Route::get('/del/{id}', [UserController::class, 'delUser'])->name('del');
        Route::match(['get', 'post'], '/edit/{id}', [UserController::class, 'editUser'])->name('edit');
    });
});
