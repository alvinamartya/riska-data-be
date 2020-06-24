<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\RestResponse;
use App\Models\Suggestion;

class SuggestionGroupController extends Controller
{

  public function index()
  {
    return RestResponse::data(Suggestion::selectRaw("`group`, count(item) as total")->groupBy("group")->get());
  }

  public function show($group)
  {
    return RestResponse::data([
      'group' => $group,
      'items' => Suggestion::whereGroup($group)->get(['id', 'item', 'display_text'])
    ]);
  }
}
