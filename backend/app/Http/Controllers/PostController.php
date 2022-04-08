<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
  public function index()
  {

    return view('/posts/index', [
      'posts' => Post::all()->sortByDesc('id')
    ]);
  }

  public function create()
  {
    return view('/posts/create');
  }

  public function store( Request $req )
  {
    // $post = Post::create([
    Post::create([
      'user_id' => Auth::id(),
      'title' => $req->get('title'),
      'content' => $req->get('content'),
    ]);

    return redirect()->route('posts.index');
  }

}
