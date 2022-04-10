<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
    // return view('top'); // 差し替え用トップページ
})->name('top');

Route::get('/dashboard', function () {
    return view('dashboard');
  })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

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
Route::get('{id}/rooms', 'App\Http\Controllers\ChatRoomController@request')->name('rooms.request');
// Route::post('rooms', 'App\Http\Controllers\ChatRoomController@request')->name('rooms.request');
// chat_messages
// Route::get('message', 'App\Http\Controllers\ChatMessageController@index')->name('message.request');
// DM機能

// プロフィール
Route::get('user/{id}', 'App\Http\Controllers\UserController@show')->name('user.show');
// プロフィール
