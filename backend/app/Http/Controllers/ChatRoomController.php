<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatRoomController extends Controller
{
  public function request($id)
  {
    // リクエストを送信先のユーザーIDを特定
    // リクエスト受信先のユーザーIDを特定
    // chat_roomsのレコードを新規作成する。
    // requested_user_idに送信ユーザー、received_user_idに受信先のユーザーID、room_statusに文字列でawaitを設定して処理完了

    $requested_user_id = (int)Auth::id();
    $received_user_id  = (int)$id;

    if ($requested_user_id === $received_user_id){
      return;
    }

    ChatRoom::create([
      'requested_user_id' => $requested_user_id,
      'received_user_id' => $received_user_id,
      'room_status' => 'await',
    ]);

    return redirect()->back()->with('successMessage', 'チャットの申請をしました');
  }

}
