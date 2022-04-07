<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Postモデルを使用
use App\Models\Post;

class PostController extends Controller
{
  public function index()
  {
    // $posts = Post::all();

    return view('/posts/index', [
      'posts' => Post::all()
    ]);
  }

}
