@extends('base')
@section('content')
<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Post;

// $own_posts      = \Illuminate\Support\Facades\DB::table('posts')->where('user_id', '=' , Auth::id())->get();
$own_posts      = \Illuminate\Support\Facades\DB::table('posts')->where('user_id', '=' , Auth::id())->orderByDesc('id')->get();
// $own_applicants = \Illuminate\Support\Facades\DB::table('applicants')->where('user_id', '=' , Auth::id())->get();
$own_applicants = \Illuminate\Support\Facades\DB::table('applicants')->where('user_id', '=' , Auth::id())->orderByDesc('id')->get();
?>

<h1>ダッシュボード</h1>

<p>Sign in as <?= Auth::user()->name; ?></p>

<form method="POST" action="{{ route('logout') }}">
  @csrf
  <a href="route('logout')"
    onclick="event.preventDefault();
    this.closest('form').submit();"
  >
  {{ __('Log Out') }}
</a>
</form>

<h2>自分の募集一覧</h2>

<?php foreach ($own_posts as $post) :?>
  <a href="<?php route('posts.show', $post->id) ?>"><?= $post->title; ?></a><span class="fs-10"><?= $post->id; ?></span>
  <br>
<?php endforeach; ?>

<h2>過去に応募した募集</h2>

<?php
foreach ($own_applicants as $apply) :
  $post = Post::find($apply->post_id);
?>
  <a href="<?php route('posts.show', $apply->id) ?>"><?= $post->title; ?></a><span class="fs-10"><?= $apply->id; ?></span>
  <br>
<?php endforeach; ?>

@endsection
