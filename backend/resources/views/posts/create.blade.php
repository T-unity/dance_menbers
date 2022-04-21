@extends('base')
@section('content')

<h1>投稿作成</h1>

<form action="{{ route('posts.store') }}" method="post">
  @csrf
  <input class="form__post-title" name="title" type="text" placeholder="タイトル">
  <textarea class="form__post-content" cols="40" rows="8" name="content" type="text" placeholder="本文を入力"></textarea>

  <div class="form__post-btn__wrapper">
    <button class="form__post-submit" type="submit">送信する</button>
  </div>

</form>

@endsection

<style>
  .form__post-title {
    width: 100%;
    padding: 10px 15px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 3px;
    border: 2px solid #ddd;
  }
  .form__post-content {
    margin-top: 3%;
    width: 100%;
    padding: 10px 15px;
    border-radius: 3px;
    border: 2px solid #ddd;
    font-size: 14px;
  }
  .form__post-btn__wrapper {
    padding-top: 3%;
    text-align: center;
  }
  .form__post-submit {
    color: rgba(255, 255, 255, 1);
    background-color: rgba(105, 162, 255, .8);
    border-radius: 5px;
    border: none;
    width: 180px;
    height: 55px;
    font-size: 19px;
    font-weight: 600;
  }
</style>
