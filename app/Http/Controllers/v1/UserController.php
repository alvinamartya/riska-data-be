<?php

namespace App\Http\Controllers\v1;

use App\Constants\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index(Request $request)
  {
    $email = $request->query('email');
    if ($email) $data = User::where('email', 'like', $email . '%')->paginate();
    else $data = User::paginate();
    return response()->json($data, HttpStatusCode::OK);
  }

  public function show(User $user)
  {
    return response()->json($user, HttpStatusCode::OK);
  }
}
