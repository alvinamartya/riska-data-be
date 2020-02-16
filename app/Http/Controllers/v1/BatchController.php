<?php

namespace App\Http\Controllers\v1;

use App\Constants\RestResponse;
use App\Http\Controllers\Controller;
use App\Models\Batch;
use Illuminate\Http\Request;

class BatchController extends Controller
{
  public function index()
  {
    return RestResponse::data(Batch::paginate());
  }

  public function show(Batch $batch)
  {
    return RestResponse::data($batch);
  }

  public function store(Request $request)
  {
    $batch = new Batch();
    $batch->name = $request->name;
    $batch->start_date = $request->start_date;
    $batch->end_date = $request->end_date;
    $batch->save();
    return RestResponse::created(Batch::class);
  }

  public function update(Request $request, Batch $batch)
  {
    $batch->name = $request->name;
    $batch->start_date = $request->start_date;
    $batch->end_date = $request->end_date;
    $batch->save();
    return RestResponse::updated(Batch::class);
  }

  public function destroy(Batch $batch)
  {
    $batch->delete();
    return RestResponse::deleted(Batch::class);
  }
}
