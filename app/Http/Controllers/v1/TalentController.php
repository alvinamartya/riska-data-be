<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\RestResponse;
use App\Models\Talent;
use Illuminate\Http\Request;

class TalentController extends Controller
{
  public function index()
  {
    return RestResponse::data(Talent::paginate());
  }

  public function show(Talent $talent)
  {
    return RestResponse::data($talent);
  }

  public function store(Request $request)
  {
    $talent = new Talent();
    $talent->name = $request->name;
    $talent->email = $request->email;
    $talent->phone_number = $request->phone_number;
    $talent->save();
    return RestResponse::created(Talent::class);
  }

  public function update(Request $request, Talent $talent)
  {
    $talent->name = $request->name;
    $talent->email = $request->email;
    $talent->phone_number = $request->phone_number;
    $talent->save();
    return RestResponse::updated(Talent::class);
  }

  public function destroy(Talent $talent)
  {
    $talent->delete();
    return RestResponse::deleted(Talent::class);
  }
}
