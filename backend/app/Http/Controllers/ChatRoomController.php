<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatRoomController extends Controller
{
  public function request($id)
  {
    $requested_user_id = (int)Auth::id();
    $received_user_id  = (int)$id;

    if ($requested_user_id === $received_user_id){
      return;
    }

    // backend/resources/views/users/show.blade.phpのテンプレート内で行っている制御を関数化して、この中でバリデーションとして使用する。
    // ユーザーがリクエストを送信するタイミングが被った場合のハンドリングを追加する。// 現状だとどんな挙動になるのかわからない。

    ChatRoom::create([
      'requested_user_id' => $requested_user_id,
      'received_user_id' => $received_user_id,
      'room_status' => 'await',
    ]);

    return redirect()->back()->with('successMessage', 'チャットの申請をしました');
  }

  public function activate($id) {
    $room = ChatRoom::find($id);
    $room->room_status = 'active';
    $room->save();

    return redirect()->back()->with('successMessage', 'チャットリクエストを許可しました');
  }

  public function show( $id )
  {
    $room = ChatRoom::find($id);

    if (Auth::id() === $room->requested_user_id || Auth::id() === $room->received_user_id ) {
      return view('users/messages/show', [
        'room_id' => $id,
      ]);
    } else {
      return;
    }

  }

}
