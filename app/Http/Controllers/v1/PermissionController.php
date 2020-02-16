<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\RestResponse;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

  public function index()
  {
    return RestResponse::data(Permission::paginate());
  }

  public function show(Permission $permission)
  {
    return RestResponse::data($permission);
  }

  public function store(Request $request)
  {
    $permission = new Permission();
    $permission->name = $request->name;
    $permission->description = $request->description;
    $permission->save();
    return RestResponse::created(Permission::class);
  }

  public function update(Request $request, Permission $permission)
  {
    $permission->description = $request->description;
    $permission->save();
    return RestResponse::updated(Permission::class);
  }

  public function destroy(Permission $permission)
  {
    $permission->delete();
    return RestResponse::deleted(Permission::class);
  }
}
