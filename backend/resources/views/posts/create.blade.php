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
  // https://developer.mozilla.org/ja/docs/Learn/JavaScript/Objects/Basics

  const confirm = {
    btn:         document.getElementById('conf-post__btn'),
    modal:       document.getElementById('conf-modal'),
    titleForm:   document.getElementById('form__post-title'),
    contentForm: document.getElementById('form__post-content'),
    titleBody:   document.getElementById('conf-title'),
    contentBody: document.getElementById('conf-content'),
  }

  confirm.btn.addEventListener('click', () => {
    confirm.modal.style.display   = 'block'
    confirm.titleBody.innerHTML   = titleForm.value
    confirm.contentBody.innerHTML = contentForm.value
  })

  const closeBtn = document.querySelectorAll('.js-close-modal')
  closeBtn.forEach((btn) => {
    btn.addEventListener('click', () => {
      confirm.modal.style.display = 'none'
    })
  })
</script>

@endsection
