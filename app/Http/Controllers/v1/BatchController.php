<?php

namespace App\Http\Controllers\v1;

use App\Models\Batch;
use Illuminate\Http\Request;
use App\Constants\HttpStatusCode;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class BatchController extends Controller
{
    public function index()
    {
        $batches = Batch::paginate();
        return response()->json($batches, HttpStatusCode::OK);
    }
    
    public function show(Batch $batch)
    {
        return response()->json($batch, HttpStatusCode::OK);
    }
    
    public function store(Request $request)
    {
        try {
            $batch = new Batch();
            $batch->name = $request->name;
            $batch->save();
        } catch (QueryException $e) {
            return response()->json(["error" => $e->errorInfo[2]], HttpStatusCode::SERVER_ERROR);
        }
        return response()->json(["message" => "Batch successfully created", "data" => $batch], HttpStatusCode::CREATED);
    }

    public function update(Request $request, Batch $batch)
    {
        try {
            $batch->name = $request->name;
            $batch->save();
        } catch (QueryException $e) {
            return response()->json(["error" => $e->errorInfo[2]], HttpStatusCode::SERVER_ERROR);
        }
        return response()->json(["message" => "Batch successfully updated"], HttpStatusCode::OK);
    }
    
    public function destroy(Batch $batch)
    {
        try {
            $batch->delete();
        } catch (\Exception $e) {
            return response()->json(["error" => $e], HttpStatusCode::SERVER_ERROR);
        }
        return response()->json(["message" => "Batch successfully deleted"], HttpStatusCode::OK);
    }
}
