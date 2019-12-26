<?php

namespace App\Http\Controllers\v1;

use App\Constants\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RoleController extends Controller
{

  public function index() {
    $roles = Role::withCount('users')->paginate();
    return response()->json($roles, HttpStatusCode::OK);
  }

  public function show($roleId) {
    try {
      $role = Role::whereId($roleId)->with('users')->firstOrFail();
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
    return response()->json(["message" => "Role successfully updated"], HttpStatusCode::OK);
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

  public function attachUser(Request $request, $roleId) {
    try {
      $email = $request->input("email");
      $user = User::whereEmail($email)->firstOrFail();
    } catch (\Exception $e) {
      return response()->json(["error" => "User with requested email is not found"], HttpStatusCode::NOT_FOUND);
    }
    try {
      $role = Role::whereId($roleId)->firstOrFail();
    } catch (\Exception $e) {
      return response()->json(["error" => "Role with requested ID is not found"], HttpStatusCode::NOT_FOUND);
    }
    try {
      $role->users()->attach($user->id, ['is_active' => true, 'expired_at' => null]);
    } catch (\Exception $e) {
      return response()->json(["error" => "User already attached to this role"], HttpStatusCode::BAD_REQUEST);
    }
    return response()->json(["message" => "User successfully attached to the role"], HttpStatusCode::CREATED);
  }

  public function updateAttachedUser(Request $request, $roleId, $userId) {
    try {
      $isActive = $request->input("is_active");
      $expiredAt = $request->input("expired_at");

      $role = Role::whereId($roleId)->firstOrFail();
      $role->users()->updateExistingPivot($userId, ['is_active' => $isActive, 'expired_at' => $expiredAt]);
    } catch (\Exception $e) {
      return response()->json(["error" => "Role with requested ID is not found"], HttpStatusCode::NOT_FOUND);
    }
    return response()->json(["message" => "Attached user for the role successfully updated"], HttpStatusCode::OK);
  }

  public function detachUser($roleId, $userId) {
    try {
      $role = Role::whereId($roleId)->firstOrFail();
      $role->users()->detach($userId);
    } catch (\Exception $e) {
      return response()->json(["error" => "Role with requested ID is not found"], HttpStatusCode::NOT_FOUND);
    }
    return response()->json(["message" => "User successfully detached from the role"], HttpStatusCode::OK);
  }
}
