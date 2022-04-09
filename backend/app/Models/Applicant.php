<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

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

    // コントローラ側でこのメソッドを呼ぶためだけにオブジェクトを生成するのが冗長だと思ったのでstaticにしたが、
    // そもそもヘルパー関数的にして関数として呼べるようにした方が便利かも？
    public static function is_applied( $id )
    {
      $user_id = Auth::id();
      // $applied = ModelsApplicant::where('user_id', $user_id);
      $query = \Illuminate\Support\Facades\DB::table('applicants')->where('user_id', '=' , $user_id);

      foreach ( $query->get() as $res ){
        if ( (int)$id === (int)$res->post_id ) {
          return false;
        }
      }

      return true;
    }
}
