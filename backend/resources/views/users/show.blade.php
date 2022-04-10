@extends('base')
@section('content')

@if (session('successMessage'))
  {{ session('successMessage') }}
@endif

<h1>ユーザー詳細</h1>

<p>ユーザーID：<?= $user->id; ?></p>
<p>ユーザー名：<?= $user->name; ?></p>

<?php
use App\Models\ChatRoom;
use Illuminate\Support\Facades\Auth;

// この冗長な感じになるのはDB設計を見直した方が良い気がする。
$to_res = \Illuminate\Support\Facades\DB::table('chat_rooms')->where([
  ['requested_user_id', '=' , Auth::id()],
  ['received_user_id',  '=' , $user->id],
])->get();

$from_res = \Illuminate\Support\Facades\DB::table('chat_rooms')->where([
  ['requested_user_id', '=' , $user->id],
  ['received_user_id',  '=' , Auth::id()],
])->get();

// レコードが存在する場合、$res[0]->idでチャットルームのIDにアクセスできる
if ( empty($to_res[0]->id) && empty($from_res[0]->id) ) :

  if ($user->id !== Auth::id()) :
  ?>
  <a href="{{ route('rooms.request', ['id' => $user->id]) }}">チャットリクエストを送る</a>
  <?php
  endif;

else :

  // ユーザー間のチャットルームを特定
  if (empty($to_res[0]->id)) {
    $room_id = $from_res[0]->id;
  } else {
    $room_id = $to_res[0]->id;
  }
  $room    = ChatRoom::find($room_id);

  // 制御に必要な情報を定義
  $requested_user_id = $room->requested_user_id;
  $received_user_id  = $room->received_user_id;
  $room_status       = $room->room_status;

  if ($room_status === 'await') {
    if ($user->id === $received_user_id) {
      echo $received_user_id . 'さんにチャットリクエストを送信しました';
    } else {
      echo $requested_user_id . 'さんからチャットリクエストが届いています';
      echo '<br>';
      echo 'リクエストを許可しますか？';
    }
  }

  if ($room_status === 'await' && $received_user_id === Auth::id()) :
    ?>
    <br>
    <a href="{{ route('rooms.activate', ['id' => $room_id]) }}">許可する</a>
    <a href="">拒否する</a>
    <br>
    <?php
  endif;

  if ($room_status === 'active') :
    ?>
    <a href="{{ route('rooms.show', ['id' => $room_id]) }}">チャットを開く</a>
    <?php
  endif;

endif;
?>

@endsection

<!--
■制御の条件
※送る側視点
・自分にはチャットリクエストを送れない
・チャットルームが存在しない場合は、申請を送る事ができる
・チャットルームが存在していて、ステータスがawaitの場合は「リクエスト申請済み」
・チャットルームが存在していて、ステータスがactiveの場合は「DMを開く」
・チャットルームが存在していて、ステータスが「denied」の場合は「現在この機能を利用できません」

※受け取る側視点
・プロフィールを閲覧したユーザーが自分にリクエストを送信している場合は、「ユーザー名さんからチャットリクエストが届いています」のテキストと、承認or拒否のボタンを表示
・承認した場合は、チャットルームがアクティブになってDM開始。
・拒否した場合は、チャットルームが無効化される。
  →一定期間経過後にレコード自体を削除して、もう一度申請を遅れるようにする？
-->
