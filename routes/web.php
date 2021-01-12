<?php

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


// ユーザーのルート
Route::namespace('User')->prefix('user')->name('user.')->group(function () {
    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset' => false,
        'verify' => false
    ]);

    // ログイン認証後
    Route::middleware('auth:user')->group(function () {
        // トップページ
        Route::resource('home', 'HomeController', ['only' => 'index']);
    });
});

// 管理者のルート
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset' => false,
        'verify' => false
    ]);

    // ログイン認証後
    Route::middleware('auth:admin')->group(function () {
        // トップページ
        Route::resource('home', 'HomeController', ['only' => 'index']);
    });
});

// Anotherのルート
Route::namespace('Another')->prefix('another')->name('another.')->group(function () {
    // ログインの認証関連
    Auth::routes([
        'register' => true,
        'reset' => false,
        'verify' => false
    ]);

    // ログイン認証後
    Route::middleware('auth:another')->group(function () {
        // トップページ
        Route::resource('home', 'HomeController', ['noly' => 'index']);
    });
});
