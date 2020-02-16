<?php

namespace App\Http\Controllers\v1;

use App\Constants\RestResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index(Request $request)
  {
    $email = $request->query('email');
    if ($email) {
      $response = User::where('email', 'like', $email . '%')->paginate();
    }
    else {
      $response = User::paginate();
    }
    return RestResponse::data($response);
  }

  public function show(User $user)
  {
    return RestResponse::data($user);
  }
}
