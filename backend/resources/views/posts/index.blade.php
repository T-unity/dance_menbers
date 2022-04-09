@extends('base')
@section('content')

<h1>投稿一覧</h1>

<?php
use App\Models\User;
foreach ( $posts as $post ) :
  $user = User::find( $post->user_id );
  ?>

<div class="container">
  <a href="<?= route('posts.show', $post->id) ?>">
    <div class="posts_wrapper">
      <div class="post_title">
        <?= $post->title ; ?>
        <span class="fs-10"><?= $post->id ; ?></span>
      </div>
      <div class="post_owner">
        <?= $user->name ; ?>
      </div>
      <div class="post_content">
        <?= $post->content ; ?>
      </div>
    </div>
  </a>
</div>

<?php endforeach; ?>

@endsection

