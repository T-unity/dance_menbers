<?php

use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;

?>
@extends('base')
@section('content')

<h1>DM画面</h1>

<?php

$results = \Illuminate\Support\Facades\DB::table('chat_messages')->where([
  ['room_id', '=' , $room_id],
])->get();

// var_dump($results);
// exit;

?>

<div class="chat_message--container">
  <!--
    ここにメッセージ一覧を表示
    要素の配置的には、画面いっぱいにメッセージボックスを配置してposition absoluteでテキスト入力フォームを画面最下部に固定すればよさそう。
    メッセージの送信、取得は非同期で行う。
  -->

  <?php
  foreach ($results as $res) {
    ?>
    <div class="chat_message--wrap">
      <p><?= $res->content; ?></p>
    </div>
    <?php
  }
  ?>
</div>

<form action="{{ route('message.store') }}" method="post">
  @csrf
  <input name="content" type="text" placeholder="本文を入力">
  <input name="send_user_id" type="hidden" value="<?= Auth::id() ?>">
  <input name="room_id" type="hidden" value="<?= (int)$room_id ?>">

  <button type="submit">送信する</button>

</form>

@endsection
