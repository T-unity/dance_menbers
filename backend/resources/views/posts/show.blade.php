@extends('base')
@section('content')

<a href="{{ route('top') }}">トップページ</a>
<br>
<a href="{{ route('posts.index') }}">投稿一覧</a>
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
<?php if (ModelsApplicant::is_applied($post->id) === false
      && ModelsApplicant::is_owned($post->id) === false): ?>
  <a href="{{ route('post.applicants', ['id' => $post->id]) }}">応募する</a>
<?php elseif (ModelsApplicant::is_owned($post->id)):
//自分の投稿の場合は何も表示しない
  else: ?>
  <p>この投稿に応募しました</p>
<?php endif; ?>

@endsection

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
