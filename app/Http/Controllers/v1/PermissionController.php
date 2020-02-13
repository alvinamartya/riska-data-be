<?php

namespace App\Http\Controllers\v1;

use App\Constants\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

  public function index()
  {
    $permissions = Permission::paginate();
    return response()->json($permissions, HttpStatusCode::OK);
  }

  public function show($permissionId)
  {
    try {
      $permission = Permission::whereId($permissionId)->firstOrFail();
    } catch (\Exception $e) {
      return response()->json(["error" => "Permission with requested ID not found"], HttpStatusCode::NOT_FOUND);
    }
    return response()->json($permission, HttpStatusCode::OK);
  }

  public function store(Request $request)
  {
    try {
      $permission = new Permission();
      $permission->name = $request->input("name");
      $permission->description = $request->input("description");
      $permission->save();
    } catch (QueryException $e) {
      return response()->json(["error" => $e->errorInfo[2]], HttpStatusCode::SERVER_ERROR);
    }
    return response()->json(["message" => "Permission successfully created", "data" => $permission], HttpStatusCode::CREATED);
  }

  public function update(Request $request, $permissionId)
  {
    try {
      $permission = Permission::whereId($permissionId)->firstOrFail();
      $permission->description = $request->input("description");
      $permission->save();
    } catch (ModelNotFoundException $e) {
      return response()->json(["error" => "Permission with requested ID not found"], HttpStatusCode::NOT_FOUND);
    } catch (QueryException $e) {
      return response()->json(["error" => $e->errorInfo[2]], HttpStatusCode::SERVER_ERROR);
    }
    return response()->json(["message" => "Permission successfully updated"], HttpStatusCode::OK);
  }

  public function destroy($permissionId)
  {
    try {
      $permission = Permission::whereId($permissionId)->firstOrFail();
      $permission->delete();
    } catch (ModelNotFoundException $e) {
      return response()->json(["error" => "Permission with requested ID not found"], HttpStatusCode::NOT_FOUND);
    } catch (\Exception $e) {
      return response()->json(["error" => $e], HttpStatusCode::SERVER_ERROR);
    }
    return response()->json(["message" => "Permission successfully deleted"], HttpStatusCode::OK);
  }
}
