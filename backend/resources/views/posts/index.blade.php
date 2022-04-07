<h1>投稿一覧</h1>

<?php
foreach ( $posts as $post ) {
  echo $post->id;
  echo $post->content;
}
