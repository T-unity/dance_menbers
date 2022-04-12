@extends('base')
@section('content')
<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;

// $own_posts      = \Illuminate\Support\Facades\DB::table('posts')->where('user_id', '=' , Auth::id())->get();
$own_posts      = \Illuminate\Support\Facades\DB::table('posts')->where('user_id', '=' , Auth::id())->orderByDesc('id')->get();
// $own_applicants = \Illuminate\Support\Facades\DB::table('applicants')->where('user_id', '=' , Auth::id())->get();
$own_applicants = \Illuminate\Support\Facades\DB::table('applicants')->where('user_id', '=' , Auth::id())->orderByDesc('id')->get();

// 通知機能
// 自分が持つ過去の募集をオブジェクトで取得
$notifications = \Illuminate\Support\Facades\DB::table('notice_applicants')->where('posted_user_id', '=' , Auth::id())->orderByDesc('id')->get();
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

<?php
foreach ($notifications as $notice) {
  $applied_user = User::find($notice->apply_user_id);
  $post = Post::find($notice->post_id);
  ?>
  <p><a href="<?= route('user.show', $notice->apply_user_id) ?>"><?= $applied_user->name ?></a> さんが <a href=" <?= route('posts.show', $notice->post_id) ?>"><?= $post->title ?></a> に応募しました</p>
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
      // ここの$applyに入っている値が意図したものになっているか要確認。
      // own_applicantsで応募テーブルから自分が応募した投稿を全部とってきて、そこから投稿テーブルのIDを特定したい。
      $post = Post::find($apply->post_id);
    ?>
      <div class="dashboard__parts">
        <a href="<?= route('posts.show', $apply->post_id) ?>"><?= $post->title; ?></a><span class="fs-10"><?= $apply->post_id; ?></span>
      </div>
    <?php endforeach; ?>
  </div>
</div>

@endsection
