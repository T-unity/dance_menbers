@extends('base')
@section('content')
<h1>SQLの実行</h1>

<form method="POST" action="sql">
  @csrf
  <input name="title" type="text" placeholder="タイトル">
  <input name="content" type="text" placeholder="本文を入力">
  <input name="user_id" type="hidden" value="6">

  <button type="submit">登録</button>
</form>

@endsection
