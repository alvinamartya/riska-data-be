<?php

namespace App\Http\Controllers\v1;

use App\Constants\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

  public function index()
  {
    return response()->json(Role::withCount('users')->paginate(), HttpStatusCode::OK);
  }

  public function show(Role $role)
  {
    return response()->json($role, HttpStatusCode::OK);
  }

  public function store(Request $request)
  {
    $role = new Role();
    $role->name = $request->name;
    $role->description = $request->description;
    $role->save();
    return response()->json(["message" => "Role successfully created"], HttpStatusCode::CREATED);
  }

  public function update(Request $request, Role $role)
  {
    $role->name = $request->name;
    $role->description = $request->description;
    $role->save();
    return response()->json(["message" => "Role successfully updated"], HttpStatusCode::OK);
  }

  public function destroy(Role $role)
  {
    $role->delete();
    return response()->json(["message" => "Role successfully deleted"], HttpStatusCode::OK);
  }
}
