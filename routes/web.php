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

// Stokのルート（テストも追加しながら実装していくのでわかりやすいようにルート設定）
// 在庫一覧のルート
Route::get('/stoks', 'StokController@index');
// 在庫詳細のルート
Route::get('/stoks/{id}', 'StokController@show');
// 在庫更新のルート
Route::put('/stoks/{id}', 'StokController@update');
// 在庫追加のルート
Route::get('/stok/new', 'StokController@new');
// 在庫作成postのルート
Route::post('/stok', 'StokController@create');
// 在庫削除のルート
Route::delete('stoks/{id}', 'StokController@delete');


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

