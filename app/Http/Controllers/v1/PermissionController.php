<?php

namespace App\Http\Controllers\v1;

use App\Constants\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

  public function index()
  {
    return response()->json(Permission::paginate(), HttpStatusCode::OK);
  }

  public function show(Permission $permission)
  {
    return response()->json($permission, HttpStatusCode::OK);
  }

  public function store(Request $request)
  {
    $permission = new Permission();
    $permission->name = $request->name;
    $permission->description = $request->description;
    $permission->save();
    return response()->json(["message" => "Permission successfully created"], HttpStatusCode::CREATED);
  }

  public function update(Request $request, Permission $permission)
  {
    $permission->description = $request->description;
    $permission->save();
    return response()->json(["message" => "Permission successfully updated"], HttpStatusCode::OK);
  }

  public function destroy(Permission $permission)
  {
    $permission->delete();
    return response()->json(["message" => "Permission successfully deleted"], HttpStatusCode::OK);
  }
}
