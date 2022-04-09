<?php

namespace App\Http\Controllers;

use App\Models\Applicant as ModelsApplicant;
use Illuminate\Support\Facades\Auth;

// コントローラー名には接尾辞の'Controllerをつけた方が良いのか、、'
class Applicant extends Controller
{

  public function store( $id )
  {
    if (ModelsApplicant::is_applied($id)) {
      return redirect()->back();
    }

    ModelsApplicant::create([
      'post_id'   => $id,
      'user_id' => Auth::id(),
    ]);

    return redirect()->back()->with('successMessage', '応募しました');
  }

}
