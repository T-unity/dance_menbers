@extends('base')
@section('content')

<h1>投稿作成</h1>

<form action="{{ route('posts.store') }}" method="post">
  @csrf

  <input name="title" type="text" placeholder="タイトル">
  <input name="content" type="text" placeholder="本文を入力">

  <button type="submit">送信する</button>

</form>

@endsection
