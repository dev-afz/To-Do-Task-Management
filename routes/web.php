<?php

use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'index')->name('/');
    Route::get('login', 'login')->name('login');
    Route::get('register', 'register')->name('register');
    Route::post('post-register', 'postRegister')->name('post-register');
    Route::get('post-login', 'postLogin')->name('post-login');
    Route::get('logout', 'logout')->name('logout');
});

Route::prefix('user')->name('user.')->middleware(['auth', 'web'])->group(function () {
    Route::name('home.')->controller(UserController::class)->group(function () {
        Route::get('/', 'home')->name('index');
        Route::post('store', 'store')->name('store');
        Route::get('edit', 'edit')->name('edit');
        Route::post('update', 'update')->name('update');
        Route::post('delete', 'destroy')->name('delete');
    });
});
