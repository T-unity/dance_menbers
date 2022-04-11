@extends('base')
@section('content')
<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Post;

// $own_posts      = \Illuminate\Support\Facades\DB::table('posts')->where('user_id', '=' , Auth::id())->get();
$own_posts      = \Illuminate\Support\Facades\DB::table('posts')->where('user_id', '=' , Auth::id())->orderByDesc('id')->get();
// $own_applicants = \Illuminate\Support\Facades\DB::table('applicants')->where('user_id', '=' , Auth::id())->get();
$own_applicants = \Illuminate\Support\Facades\DB::table('applicants')->where('user_id', '=' , Auth::id())->orderByDesc('id')->get();
$notifications  = \Illuminate\Support\Facades\DB::table('notice_applicants')->where('posted_user_id', '=' , Auth::id())->orderByDesc('id')->get();
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

<h2>通知一覧</h2>

<!-- 最終的な出力内容は、「user_nameさんが、post_idに応募しました」のようなテキストを想定 -->

<?php
// var_dump($notifications);
foreach ($notifications as $notice) {
  // idではなくユーザー名と投稿名で表示してかつリンクにする。
  ?>
  <p><?= $notice->apply_user_id ?>さんが<?= $notice->post_id ?>の投稿に応募しました</p>
  <?php
}
?>
<div class="dashboard__wrapper">
  <div class="dashboard__parts--wrapper">
    <h2>自分の募集一覧</h2>
    <?php foreach ($own_posts as $post) :?>
      <div class="dashboard__parts">
        <a href="<?= route('posts.show', $post->id) ?>"><?= $post->title; ?></a><span class="fs-10"><?= $post->id; ?></span>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="dashboard__parts--wrapper">
    <h2>過去に応募した募集</h2>
    <?php
    foreach ($own_applicants as $apply) :
      $post = Post::find($apply->post_id);
    ?>
      <div class="dashboard__parts">
        <a href="<?= route('posts.show', $apply->id) ?>"><?= $post->title; ?></a><span class="fs-10"><?= $apply->id; ?></span>
      </div>
    <?php endforeach; ?>
  </div>
</div>


@endsection

<style>
  .dashboard__wrapper {
    display: flex;
    flex-wrap: wrap;
    justify-content: start;
    padding: 3%;
  }
  .dashboard__parts--wrapper {
    background-color: #fff;
    width: 30%;
    padding: 1% 2%;
    margin: 2%;
  }
  .dashboard__parts {
    margin: 1% auto;
  }
</style>
