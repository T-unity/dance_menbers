<?php

namespace App\Http\Controllers;

use App\Models\Applicant as ModelsApplicant;
use Illuminate\Http\Request;

//
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

// コントローラー名には接尾辞の'Controllerをつけた方が良いのか、、'
class Applicant extends Controller
{
  public function store( $id )
  {
    // var_dump($id);
    // echo '<br>';
    // var_dump(Auth::id());
    // exit;

    // $post_id = $id;
    // $user_id = Auth::id();

    // レコードの重複を避ける検査が必要。
    // post_idもしくはuser_idを固定して、抽出したレコードの中から
    // 更にどちらかのIDに一致するレコードがあるか捜査すればよさそう。

    $user_id = Auth::id();
    // $applied = ModelsApplicant::where('user_id', $user_id);


    $query = \Illuminate\Support\Facades\DB::table('applicants')->where('user_id', '=' , $user_id);

    // var_dump($query);
    // var_dump($query->get());

    foreach ( $query->get() as $res ){
      // echo $res->post_id;
      // var_dump($res->post_id);
      // var_dump($id);
      if ( (int)$id === (int)$res->post_id ) {
        var_dump('NG');
        exit;
      }
    }
    // exit;

    ModelsApplicant::create([
      'post_id'   => $id,
      'user_id' => Auth::id(),
    ]);

    return redirect()->back();
  }

  // public function is_applied()
  // {
  //   //
  // }
}
