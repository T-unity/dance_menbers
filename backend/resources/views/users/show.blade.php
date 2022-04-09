@extends('base')
@section('content')

<h1>ユーザー詳細</h1>

<?php
echo $user->id;
echo $user->name;
?>

<br>

<a href="{{ route('rooms.request', ['id' => $user->id]) }}">メッセージリクエストを送る</a>

@endsection
