<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\RestResponse;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index(Request $request)
  {
    $email = $request->query('email');
    if ($email) {
      $response = User::where('email', 'like', $email . '%')->paginate();
    } else {
      $response = User::paginate();
    }
    return RestResponse::data($response);
  }

  public function show(User $user)
  {
    return RestResponse::data($user);
  }

  public function update(Request $request, User $user)
  {
    $user->whatsapp_number = $this->sanitizeWhatsapp($request->get("whatsapp_number"));
    $user->save();
    return RestResponse::updated(User::class);
  }

  private function sanitizeWhatsapp($phoneNumber) {
    $phoneNumber = str_replace(["+", "-", " "], "", $phoneNumber);
    if (substr($phoneNumber, 0, 1) == "0") $phoneNumber = "62" . substr($phoneNumber, 1);
    return $phoneNumber;
  }
}
