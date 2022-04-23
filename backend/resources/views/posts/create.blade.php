@extends('base')
@section('content')

<h1>投稿作成</h1>

<form action="{{ route('posts.store') }}" method="post">
  @csrf
  <input id="form__post-title" class="form__post-title" name="title" type="text" placeholder="タイトル">
  <textarea id="form__post-content" class="form__post-content" cols="40" rows="8" name="content" type="text" placeholder="本文を入力"></textarea>

  <div class="form__post-btn__wrapper">
    <span id="conf-post__btn" class="form__post-submit">投稿内容を確認</span>
  </div>

  <div id="conf-modal" class="conf-post__wrap">
    <div class="conf-modal__overlay js-close-modal"></div>
    <div class="conf-post__content">
      <h2>以下の内容で投稿してよろしいですか？</h2>
      <span class="js-close-modal">❎</span>
      <p>タイトル</p>
      <p id="conf-title"></p>
      <p>本文</p>
      <p id="conf-content"></p>
      <button class="form__post-submit" type="submit">送信する</button>
    </div>
  </div>

</form>

<script>
  const btn = document.getElementById('conf-post__btn')
  const modal = document.getElementById('conf-modal')
  const title = document.getElementById('form__post-title')
  const content = document.getElementById('form__post-content')
  const confirmTitle = document.getElementById('conf-title')
  const confirmContent = document.getElementById('conf-content')

  btn.addEventListener('click', () => {
    modal.style.display = 'block'
    confirmTitle.innerHTML = title.value
    confirmContent.innerHTML = content.value
  })

  const closeBtn = document.querySelectorAll('.js-close-modal')
  closeBtn.forEach((btn) => {
    btn.addEventListener('click', () => {
      modal.style.display = 'none'
    })
  })
</script>

@endsection
