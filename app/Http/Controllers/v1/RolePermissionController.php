<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\RestResponse;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{

  public function index(Role $role)
  {
    return RestResponse::data($role->permissions);
  }

  public function store(Request $request, Role $role)
  {
    $permission = Permission::whereId($request->permission_id)->firstOrFail();
    $role->permissions()->attach($permission->id);
    return RestResponse::attached(Role::class, Permission::class);
  }

  public function destroy(Role $role, Permission $permission)
  {
    $role->permissions()->detach($permission->id);
    return RestResponse::detached(Role::class, Permission::class);
  }
}
