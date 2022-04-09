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
    /**
     * ユーザーが投稿に対して、既に応募済かどうかを判定する。
     *
     * @param int $id | 投稿のID(Primary Key)
     * @return bool | 未応募ならFalse、応募済ならTrue
     */
    public static function is_applied($id)
    {
      $user_id = Auth::id();
      $results = \Illuminate\Support\Facades\DB::table('applicants')->where('user_id', '=' , $user_id)->get();

      foreach ( $results as $res ){
        if ( (int)$id === (int)$res->post_id ) {
          return true;
        }
      }

      return false;
    }

    public static function is_owned( $id ) {
      $posted_user = Post::find($id)->user_id;

      if ((int)$posted_user === (int)Auth::id()) {
        return true;
      }

      return false;
    }
}
