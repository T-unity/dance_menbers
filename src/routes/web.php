<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return view('top'); // 差し替え用トップページ
})->name('top');

Route::get('/dashboard', function () {
    return view('dashboard');
  })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

// プロフィール
Route::get('user/{id}', 'App\Http\Controllers\UserController@show')->name('user.show');
Route::get('users', 'App\Http\Controllers\UserController@index')->name('users.index');
// プロフィール

// 投稿機能
Route::get('/posts', 'App\Http\Controllers\PostController@index')->name('posts.index');
Route::get('/posts/create', 'App\Http\Controllers\PostController@create' )->middleware(['auth'])->name('posts.create');
Route::post('/posts', 'App\Http\Controllers\PostController@store')->middleware(['auth'])->name('posts.store');
Route::get('/posts/{post}', 'App\Http\Controllers\PostController@show' )->name('posts.show');
// 投稿機能

// 応募機能
// postリクエストで実行するには？→たぶんaタグ使ってるからpostできてない気がする。
Route::get('post/{id}/applicants', 'App\Http\Controllers\Applicant@store')->name('post.applicants');
// Route::get('post/{id}/unapply', 'App\Http\Controllers\Applicant@store' )->name('post.unapply');
// 応募機能

// DM機能
// chat_rooms
// Authの制限全くかけていなかったのでミドルウェア経由させる。
Route::get('{id}/rooms', 'App\Http\Controllers\ChatRoomController@request')->name('rooms.request');
Route::get('rooms/{id}', 'App\Http\Controllers\ChatRoomController@activate')->name('rooms.activate');
Route::get('room/{id}', 'App\Http\Controllers\ChatRoomController@show')->name('rooms.show');
// chat_messages
Route::post('message', 'App\Http\Controllers\ChatMessageController@store')->name('message.store');
// DM機能


//////////////////////////
/// 以下は運用とは関係ない

// SQLの練習用ファイル
Route::get('/sql', 'App\Http\Controllers\SqlController@some')->name('sql');
Route::post('/sql', 'App\Http\Controllers\SqlController@insert');

// パフォーマンス測定用
Route::get('user_performance/', 'App\Http\Controllers\UserController@performance')->name('users_pref.index');
Route::get('sql_user_performance/', 'App\Http\Controllers\SqlController@index')->name('users.sql');
