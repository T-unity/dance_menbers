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
    // var_dump( $req );
    // var_dump( $req->all() );
    // dd( $req );
    // var_dump( $req->get('content') );
    // exit;
    $post = Post::create([
      'content' => $req->get('content')
    ]);

    // return view( 'posts.index' );
    return redirect()->route('posts.index');
  }

}
