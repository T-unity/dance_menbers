<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeApplicant extends Model
{
    use HasFactory;

    protected $fillable = [
      'apply_user_id',
      'post_id',
      'posted_user_id',
    ];
}
