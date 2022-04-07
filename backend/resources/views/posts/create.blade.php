
<h1>投稿作成</h1>

<form action="{{ route('posts.store') }}" method="post">
  @csrf

  <input type="text">

  <button type="submit">送信する</button>

</form>
