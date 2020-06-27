<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\RestResponse;
use App\Models\Suggestion;
use DB;
use Exception;
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

    try {
      DB::beginTransaction();

      foreach ($request->items as $item) {
        $suggestion = new Suggestion();
        $suggestion->group = $request->group;
        $suggestion->item = $item['item'];
        $suggestion->display_text = $item['display_text'];
        $suggestion->save();
      }
    } catch (Exception $e) {
      DB::rollBack();
      return RestResponse::error($e->getMessage());
    }
    DB::commit();

    return RestResponse::created(Suggestion::class);
  }

  public function show($suggestion_group)
  {
    return RestResponse::data([
      'group' => $suggestion_group,
      'items' => Suggestion::whereGroup($suggestion_group)->orderBy('id')->get(['id', 'item', 'display_text'])
    ]);
  }

  public function update(Request $request, $suggestion_group)
  {
    if (!Suggestion::whereGroup($suggestion_group)->exists()) {
      return RestResponse::conflict("group not exists!");
    }

    try {
      DB::beginTransaction();

      Suggestion::whereGroup($suggestion_group)->delete();

      foreach ($request->items as $item) {
        if (empty($item['item']) || empty($item['display_text'])) throw new Exception("null on required field");
        $suggestion = new Suggestion();
        $suggestion->group = $suggestion_group;
        $suggestion->item = $item['item'];
        $suggestion->display_text = $item['display_text'];
        $suggestion->save();
      }
    } catch (Exception $e) {
      DB::rollBack();
      return RestResponse::error($e->getMessage());
    }
    DB::commit();

    return RestResponse::updated(Suggestion::class);
  }
}
