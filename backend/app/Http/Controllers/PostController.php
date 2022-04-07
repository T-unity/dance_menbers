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

  public function create()
  {
    return view('/posts/create');
  }

  public function store( Request $req )
  {
    // return;
    var_dump( $req );
    exit;
  }

}
