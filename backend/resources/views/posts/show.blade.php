<h1>投稿詳細</h1>

<?php

echo $post->title;
echo '<br>';
echo $post->content;
echo '<br>';
echo $user->name;

?>
<br>
<a href="{{ route('post.applicants', ['id' => $post->id]) }}">応募する</a>

<style>
  a {
    border: solid 1px;
    border-radius: 3px;
    padding: 2px 1%;
    text-decoration: none;
    color: inherit;
    background-color: #fff;
  }
</style>
