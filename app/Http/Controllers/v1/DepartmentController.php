<?php

namespace App\Http\Controllers\v1;

use App\Constants\RestResponse;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
  public function index()
  {
    return RestResponse::data(Department::paginate());
  }

  public function show(Department $department)
  {
    return RestResponse::data($department);
  }

  public function store(Request $request)
  {
    $department = new Department();
    $department->code = $request->code;
    $department->name = $request->name;
    $department->save();
    return RestResponse::created(Department::class);
  }

  public function update(Request $request, Department $department)
  {
    $department->code = $request->code;
    $department->name = $request->name;
    $department->save();
    return RestResponse::updated(Department::class);
  }

  public function destroy(Department $department)
  {
    $department->delete();
    return RestResponse::deleted(Department::class);
  }
}
