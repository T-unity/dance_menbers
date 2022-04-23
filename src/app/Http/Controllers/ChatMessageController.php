<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatMessageController extends Controller
{

  public function store(Request $req)
  {
    ChatMessage::create([
      'room_id'      => $req->get('room_id'),
      'send_user_id' => $req->get('send_user_id'),
      'content'      => $req->get('content'),
    ]);

    return redirect()->back();
  }
}
