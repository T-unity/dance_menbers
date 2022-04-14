@extends('base')
@section('content')

<h1>投稿詳細</h1>

@if (session('successMessage'))
  {{ session('successMessage') }}
@endif

<p>タイトル：<?= $post->title; ?></a></p>
<p>本文：<?= $post->content; ?></a></p>
<p>投稿者：<a href="<?= route('user.show', ['id' => $user->id]) ?>"><?= $user->name; ?></a></p>

<br>

<?php
use App\Models\Applicant as ModelsApplicant;
    if (ModelsApplicant::is_applied($post->id) === false
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
