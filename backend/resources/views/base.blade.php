<?php

use Illuminate\Support\Facades\Auth;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('static/style.css') }}">

  <title>Document</title>
  <style>
    body {
      font-family: 'Noto Serif JP', serif;
    }
  </style>
</head>
<body>
  <?= Auth::id() ?>
  <br>
  <a href="{{ route('dashboard') }}">ダッシュボード</a>
  <br>
  <a href="{{ route('top') }}">トップページ</a>
  <br>
  <a href="{{ route('posts.index') }}">投稿一覧</a>
  <br>
  <a href="{{ route('posts.create') }}">投稿の新規作成</a>
  @yield('content')
</body>
</html>
