<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\RestResponse;
use App\Models\Suggestion;
use Illuminate\Http\Request;

class SuggestionGroupController extends Controller
{

  public function index()
  {
    return RestResponse::data(Suggestion::selectRaw("`group`, count(item) as total")->groupBy("group")->orderBy('group')->get());
  }

  public function store(Request $request)
  {
    if (Suggestion::whereGroup($request->group)->exists()) {
      return RestResponse::conflict("group already exists!");
    }

    foreach ($request->items as $item) {
      $suggestion = new Suggestion();
      $suggestion->group = $request->group;
      $suggestion->item = $item->item;
      $suggestion->display_text = $item->display_text;
      $suggestion->save();
    }

    return RestResponse::created($suggestion);
  }

  public function show($suggestion_group)
  {
    return RestResponse::data([
      'group' => $suggestion_group,
      'items' => Suggestion::whereGroup($suggestion_group)->get(['id', 'item', 'display_text'])
    ]);
  }

  public function update(Request $request, $suggestion_group)
  {
    if (!Suggestion::whereGroup($suggestion_group)->exists()) {
      return RestResponse::conflict("group not exists!");
    }

    Suggestion::whereGroup($suggestion_group)->delete();

    foreach ($request->items as $item) {
      $suggestion = new Suggestion();
      $suggestion->group = $suggestion_group;
      $suggestion->item = $item->item;
      $suggestion->display_text = $item->display_text;
      $suggestion->save();
    }

    return RestResponse::updated($suggestion);
  }
}
