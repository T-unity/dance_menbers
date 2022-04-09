<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('static/style.css') }}">

  <!-- web font -->
  <!-- <link rel="preconnect" href="https://fonts.googleapis.com"> -->
  <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
  <!-- <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP&display=swap" rel="stylesheet"> -->

  <title>Document</title>
  <style>
    body {
      font-family: 'Noto Serif JP', serif;
    }
  </style>
</head>
<body>
  @yield('content')
</body>
</html>
