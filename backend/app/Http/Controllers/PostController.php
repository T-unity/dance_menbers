<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
// use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
  public function index()
  {
    // $posts = Post::all();
    // $user =

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
    // var_dump( Auth::id() );

    // dd( $req );
    // var_dump( $req->get('content') );
    // exit;

    // $posted_user = Auth::id();

    // $post = Post::create([
    Post::create([
      'user_id' => Auth::id(),
      'content' => $req->get('content'),
    ]);

    // return view( 'posts.index' );
    return redirect()->route('posts.index');
  }

}
