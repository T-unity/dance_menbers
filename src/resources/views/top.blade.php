@extends('base')
@section('content')

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

@endsection
