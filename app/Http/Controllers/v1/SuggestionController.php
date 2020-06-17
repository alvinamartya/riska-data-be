<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\RestResponse;
use App\Models\Suggestion;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{

  public function index()
  {
    return RestResponse::data(Suggestion::paginate());
  }

  public function store(Request $request)
  {
    $suggestion = new Suggestion();
    $suggestion->group = $request->group;
    $suggestion->item = $request->item;
    $suggestion->display_text = $request->display_text;
    $suggestion->save();
    return RestResponse::created($suggestion);
  }

  public function show(Suggestion $suggestion)
  {
    return RestResponse::data($suggestion);
  }

  public function update(Request $request, Suggestion $suggestion)
  {
    $suggestion->group = $request->group;
    $suggestion->item = $request->item;
    $suggestion->display_text = $request->display_text;
    $suggestion->save();
    return RestResponse::updated($suggestion);
  }

  public function destroy(Suggestion $suggestion)
  {
    $suggestion->delete();
    return RestResponse::deleted($suggestion);
  }
}
