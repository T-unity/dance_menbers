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
  @extends('header')
  <div class="container">
    @yield('content')
  </div>
</body>
</html>
