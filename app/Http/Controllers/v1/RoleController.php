<?php

namespace App\Http\Controllers\v1;

use App\Constants\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RoleController extends Controller
{

  public function index() {
    $roles = Role::paginate();
    return response()->json($roles, HttpStatusCode::OK);
  }

  public function show($roleId) {
    try {
      $role = Role::whereId($roleId)->firstOrFail();
    } catch (\Exception $e) {
      return response()->json(["error" => "Role with requested ID not found"], HttpStatusCode::NOT_FOUND);
    }
    return response()->json($role, HttpStatusCode::OK);
  }

  public function store(Request $request) {
    try {
      $role = new Role();
      $role->name = $request->input("name");
      $role->description = $request->input("description");
      $role->save();
    } catch (QueryException $e) {
      return response()->json(["error" => $e->errorInfo[2]], HttpStatusCode::SERVER_ERROR);
    }
    return response()->json(["message" => "Role successfully created", "data" => $role], HttpStatusCode::CREATED);
  }

  public function update(Request $request, $roleId)
  {
    try {
      $role = Role::whereId($roleId)->firstOrFail();
      $role->name = $request->input("name");
      $role->description = $request->input("description");
      $role->save();
    } catch (ModelNotFoundException $e) {
      return response()->json(["error" => "Role with requested ID not found"], HttpStatusCode::NOT_FOUND);
    } catch (QueryException $e) {
      return response()->json(["error" => $e->errorInfo[2]], HttpStatusCode::SERVER_ERROR);
    }
    return response()->json(["message" => "Role successfully updated", "data" => $role], HttpStatusCode::OK);
  }

  public function destroy($roleId)
  {
    try {
      $role = Role::whereId($roleId)->firstOrFail();
      $role->delete();
    } catch (ModelNotFoundException $e) {
      return response()->json(["error" => "Role with requested ID not found"], HttpStatusCode::NOT_FOUND);
    } catch (\Exception $e) {
      return response()->json(["error" => $e], HttpStatusCode::SERVER_ERROR);
    }
    return response()->json(["message" => "Role successfully deleted"], HttpStatusCode::OK);
  }
}
