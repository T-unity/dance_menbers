<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'post_id',
    ];

    /**
     * テーブル間のリレーション
     */
    public function user()
    {
      return $this->hasMany('App\Models\User');
    }
    public function post()
    {
      return $this->hasMany('App\Models\Post');
    }
}
