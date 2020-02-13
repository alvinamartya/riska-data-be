<?php

namespace App\Http\Controllers\v1;

use App\Constants\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleMemberController extends Controller
{

  public function index(Role $role)
  {
    return response()->json($role->users, HttpStatusCode::OK);
  }

  public function store(Request $request, Role $role)
  {
    $user = User::whereEmail($request->email)->firstOrFail();
    $role->users()->attach($user->id, ['is_active' => true, 'expired_at' => null]);
    return response()->json(["message" => "User successfully attached to the role"], HttpStatusCode::CREATED);
  }

  public function update(Request $request, Role $role, User $user)
  {
    $role->users()->updateExistingPivot($user->id, ['is_active' => $request->is_active, 'expired_at' => $request->expired_at]);
    return response()->json(["message" => "User successfully attached to the role"], HttpStatusCode::OK);
  }

  public function destroy(Role $role, User $user)
  {
    $role->users()->detach($user->id);
    return response()->json(["message" => "User successfully detached from the role"], HttpStatusCode::OK);
  }
}
