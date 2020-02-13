<?php

namespace App\Http\Controllers\v1;

use App\Constants\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
  public function index()
  {
    $departments = Department::paginate();
    return response()->json($departments, HttpStatusCode::OK);
  }

  public function show(Department $department)
  {
    return response()->json($department, HttpStatusCode::OK);
  }

  public function store(Request $request)
  {
    try {
      $department = new Department();
      $department->code = $request->code;
      $department->name = $request->name;
      $department->save();
    } catch (QueryException $e) {
      return response()->json(["error" => $e->errorInfo[2]], HttpStatusCode::SERVER_ERROR);
    }
    return response()->json(["message" => "Department successfully created", "data" => $department], HttpStatusCode::CREATED);
  }

  public function update(Request $request, Department $department)
  {
    try {
      $department->code = $request->code;
      $department->name = $request->name;
      $department->save();
    } catch (QueryException $e) {
      return response()->json(["error" => $e->errorInfo[2]], HttpStatusCode::SERVER_ERROR);
    }
    return response()->json(["message" => "Department successfully updated"], HttpStatusCode::OK);
  }

  public function destroy(Department $department)
  {
    try {
      $department->delete();
    } catch (\Exception $e) {
      return response()->json(["error" => $e], HttpStatusCode::SERVER_ERROR);
    }
    return response()->json(["message" => "Department successfully deleted"], HttpStatusCode::OK);
  }
}
