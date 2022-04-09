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
    $user_id = Auth::id();
    // $applied = ModelsApplicant::where('user_id', $user_id);
    $query = \Illuminate\Support\Facades\DB::table('applicants')->where('user_id', '=' , $user_id);

    foreach ( $query->get() as $res ){
      if ( (int)$id === (int)$res->post_id ) {
        var_dump('NG');
        exit;
      }
    }

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
