<?php

namespace App\Http\Controllers\v1;

use App\Constants\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
  public function index()
  {
    return response()->json(Department::paginate(), HttpStatusCode::OK);
  }

  public function show(Department $department)
  {
    return response()->json($department, HttpStatusCode::OK);
  }

  public function store(Request $request)
  {
    $department = new Department();
    $department->code = $request->code;
    $department->name = $request->name;
    $department->save();
    return response()->json(["message" => "Department successfully created"], HttpStatusCode::CREATED);
  }

  public function update(Request $request, Department $department)
  {
    $department->code = $request->code;
    $department->name = $request->name;
    $department->save();
    return response()->json(["message" => "Department successfully updated"], HttpStatusCode::OK);
  }

  public function destroy(Department $department)
  {
    $department->delete();
    return response()->json(["message" => "Department successfully deleted"], HttpStatusCode::OK);
  }
}
