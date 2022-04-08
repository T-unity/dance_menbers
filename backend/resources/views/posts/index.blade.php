<h1>投稿一覧</h1>

<?php
use App\Models\User;

foreach ( $posts as $post ) {
  $user = User::find( $post->user_id );
  echo $user->name . '(' . $post->user_id . ')';
  echo '<br>';
  echo $post->id . PHP_EOL;
  echo '<br>';
  echo $post->content . PHP_EOL;
  echo '<br>';
  echo '----------';
  echo '<br>';
}
