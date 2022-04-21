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
  <link rel="stylesheet" href="{{ asset('/static/style.css') }}">

  <title>Document</title>
  <style>
    body {
      font-family: 'Noto Serif JP', serif;
    }
  </style>
</head>
<body>
  <?= Auth::id() ?>

  <header>
    <div class='globalNav'>
      <div class='inner'>
        <div class='contents__wrap'>
          <h1>
            <a href='/'>Dancers</a>
          </h1>
          <div class='contents__menu'>
            <ul class='contents__lists'>
              <li><a href="{{ route('dashboard') }}">ダッシュボード</a></li>
              <li><a href="{{ route('top') }}">トップページ</a></li>
              <li><a href="{{ route('posts.index') }}">投稿一覧</a></li>
              <li><a href="{{ route('posts.create') }}">新規投稿</a></li>
              <li><a href="{{ route('sql') }}">新規投稿（PDO）</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </header>

  @yield('content')
</body>
</html>
