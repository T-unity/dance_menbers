<h1>投稿一覧</h1>

<?php
use App\Models\User;
foreach ( $posts as $post ) :
  $user = User::find( $post->user_id );
  ?>

<div class="container">
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
</div>

<?php endforeach; ?>

<style>
  .container {
    width: 80%;
    margin: 0 auto;
  }
  .posts_wrapper {
    width: calc(100% - 80px);
    background-color: #f0f0f0;
    margin: 1%;
    padding: 1%;
  }
  .fs-10 {
    font-size: 10px;
  }
</style>
