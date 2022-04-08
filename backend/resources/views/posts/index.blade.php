<h1>投稿一覧</h1>

<?php
foreach ( $posts as $post ) {
  echo $post->user_id . PHP_EOL;
  echo '<br>';
  echo $post->id . PHP_EOL;
  echo '<br>';
  echo $post->content . PHP_EOL;
  echo '<br>';
  echo '----------';
  echo '<br>';
}
