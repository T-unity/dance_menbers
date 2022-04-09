<?php
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
    // return view('top'); // 差し替え用トップページ
});

Route::get('/dashboard', function () {
    return view('dashboard');
  })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/posts', 'App\Http\Controllers\PostController@index' )->name('posts.index');
// Route::get('/posts', 'App\Http\Controllers\PostController@index' )->middleware(['auth'])->name('posts.index');
Route::get('/posts/create', 'App\Http\Controllers\PostController@create' )->middleware(['auth']);
// Route::post('/posts', 'App\Http\Controllers\PostController@index' );
Route::post('/posts', 'App\Http\Controllers\PostController@store' )->middleware(['auth'])->name('posts.store');
Route::get('/posts/{post}', 'App\Http\Controllers\PostController@show' )->name('posts.show');
