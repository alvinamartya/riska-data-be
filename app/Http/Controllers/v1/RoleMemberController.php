<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\RestResponse;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleMemberController extends Controller
{

  public function index(Role $role)
  {
    return RestResponse::data($role->users);
  }

  public function store(Request $request, Role $role)
  {
    $user = User::whereEmail($request->email)->firstOrFail();
    if ($role->users->contains($user->id)) {
      return RestResponse::conflict("User already attached to the role");
    }
    $role->users()->attach($user->id, ['is_active' => true, 'expired_at' => null]);
    return RestResponse::attached(Role::class, User::class);
  }

  public function update(Request $request, Role $role, User $user)
  {
    $role->users()->updateExistingPivot($user->id, ['is_active' => $request->is_active, 'expired_at' => $request->expired_at]);
    return RestResponse::uptached(Role::class, User::class);
  }

  public function destroy(Role $role, User $user)
  {
    $role->users()->detach($user->id);
    return RestResponse::detached(Role::class, User::class);
  }
}
