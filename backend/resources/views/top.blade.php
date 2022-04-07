<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

@if (Route::has('login'))
  @auth
    <a href="{{ url('/dashboard') }}">Dashboard</a>
  @else
    <a href="{{ route('login') }}">ログイン</a>
    @if (Route::has('register'))
      <a href="{{ route('register') }}">登録</a>
    @endif
  @endauth
@endif

</body>
</html>
