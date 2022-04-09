<a href="{{ route('top') }}">トップページ</a>
<br>
<a href="{{ route('posts.create') }}">投稿の新規作成</a>
<h1>投稿詳細</h1>

@if (session('successMessage'))
  {{ session('successMessage') }}
@endif

<?php

echo $post->title;
echo '<br>';
echo $post->content;
echo '<br>';
echo $user->name;

use App\Models\Applicant as ModelsApplicant;
?>
<br>
<?php if (ModelsApplicant::is_applied($post->id) === false): ?>
  <a href="{{ route('post.applicants', ['id' => $post->id]) }}">応募する</a>
<?php endif; ?>

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
