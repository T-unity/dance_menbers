@extends('base')
@section('content')

<h1>投稿詳細</h1>

@if (session('successMessage'))
  {{ session('successMessage') }}
@endif

<p>タイトル：<?= $post->title; ?></p>
<p>本文：<?= $post->content; ?></p>
<p>投稿者：<a href="<?= route('user.show', ['id' => $user->id]) ?>"><?= $user->name; ?></a></p>

<br>

<?php
use App\Models\Applicant as ModelsApplicant;

if (ModelsApplicant::is_applied($post->id) === false
  && ModelsApplicant::is_owned($post->id) === false):
  ?>
  <div class="applicant">
    <a href="{{ route('post.applicants', ['id' => $post->id]) }}">応募する</a>
  </div>
<?php
  elseif (ModelsApplicant::is_owned($post->id)):
    //自分の投稿の場合は何も表示しない
  else:
  ?>
  <p>この投稿に応募しました</p>
<?php endif; ?>

@endsection
