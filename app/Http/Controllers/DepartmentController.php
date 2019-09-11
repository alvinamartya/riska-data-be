<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
  public function index()
  {
    return Department::all();
  }

  public function show(Department $department)
  {
    return $department;
  }

  public function store(Request $request)
  {
    $department = Department::create($request->all());

    return response()->json($department, 201);
  }

  public function update(Request $request, Department $department)
  {
    $department->update($request->all());

    return response()->json($department, 200);
  }

  public function delete(Department $department)
  {
    try {
      $department->delete();
    } catch (\Exception $e) {
      return response()->json($e, 400);
    }

    return response()->json(null, 204);
  }
}
