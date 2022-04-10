<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
  use HasFactory;

  protected $fillable = [
    'requested_user_id',
    'received_user_id',
    'room_status',
  ];
}
