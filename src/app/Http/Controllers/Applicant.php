<?php

namespace App\Http\Controllers;

use App\Models\Applicant as ModelsApplicant;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

use App\Models\NoticeApplicant;

// コントローラー名には接尾辞の'Controllerをつけた方が良いのか、、
class Applicant extends Controller
{

  public function store( $id )
  {

    if (ModelsApplicant::is_owned($id)) {
      return redirect()->back();
    }

    if (ModelsApplicant::is_applied($id)) {
      return redirect()->back();
    }

    // $posted_user = Post::find($id)->user_id;
    // var_dump($posted_user);
    // exit;

    ModelsApplicant::create([
      'post_id' => $id,
      'user_id' => Auth::id(),
    ]);

    NoticeApplicant::create([
      'apply_user_id' => Auth::id(),
      'post_id' => $id,
      'posted_user_id' => Post::find($id)->user_id,
    ]);

    return redirect()->back()->with('successMessage', '応募しました');
  }

}
