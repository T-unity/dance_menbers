<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
  public function index()
  {
    return view('/users/index', [
      'users' => User::all()->sortByDesc('id')
    ]);
  }
  public function show( $id )
  {
    return view('users/show', [
      'user' => User::find($id)
    ]);
  }



  /**
   * 全件取得のパフォーマンス計測用メソッド
   */
  public function performance()
  {
    $start = hrtime(true); // 計測開始時間

    User::all();

    $end = hrtime(true); // 計測終了時間

    // 終了時間から開始時間を引くと処理時間になる
    $nano_sec = $end - $start;
    $micro_sec = $nano_sec / 1000;
    $milli_sec = $micro_sec / 1000;
    $sec = $milli_sec / 1000;
    echo '処理時間:'. $nano_sec .'ナノ秒' . '<br>';
    echo '処理時間:'. $micro_sec .'マイクロ秒' . '<br>';
    echo '処理時間:'. $milli_sec .'ミリ秒' . '<br>';
    echo '処理時間:'. $sec .'秒' . '<br>';
  }
}
