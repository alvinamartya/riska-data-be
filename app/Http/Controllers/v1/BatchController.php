<?php

namespace App\Http\Controllers\v1;

use App\Constants\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Models\Batch;
use Illuminate\Http\Request;

class BatchController extends Controller
{
  public function index()
  {
    return response()->json(Batch::paginate(), HttpStatusCode::OK);
  }

  public function show(Batch $batch)
  {
    return response()->json($batch, HttpStatusCode::OK);
  }

  public function store(Request $request)
  {
    $batch = new Batch();
    $batch->name = $request->name;
    $batch->start_date = $request->start_date;
    $batch->end_date = $request->end_date;
    $batch->save();
    return response()->json(["message" => "Batch successfully created"], HttpStatusCode::CREATED);
  }

  public function update(Request $request, Batch $batch)
  {
    $batch->name = $request->name;
    $batch->start_date = $request->start_date;
    $batch->end_date = $request->end_date;
    $batch->save();
    return response()->json(["message" => "Batch successfully updated"], HttpStatusCode::OK);
  }

  public function destroy(Batch $batch)
  {
    $batch->delete();
    return response()->json(["message" => "Batch successfully deleted"], HttpStatusCode::OK);
  }
}
