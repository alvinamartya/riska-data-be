<?php

namespace App\Http\Controllers\v1;

use App\Constants\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{

  public function index(Role $role)
  {
    return response()->json($role->permissions, HttpStatusCode::OK);
  }

  public function store(Request $request, Role $role)
  {
    $permission = Permission::whereId($request->permission_id)->firstOrFail();
    $role->permissions()->attach($permission->id);
    return response()->json(["message" => "Permission successfully attached to the role"], HttpStatusCode::CREATED);
  }

  public function destroy(Role $role, Permission $permission)
  {
    $role->permissions()->detach($permission->id);
    return response()->json(["message" => "Permission successfully detached from the role"], HttpStatusCode::OK);
  }
}
