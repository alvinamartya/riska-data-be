<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\RestResponse;
use App\Models\WhatsappBot;
use Illuminate\Http\Request;

class WhatsappBotController extends Controller
{

  public function index()
  {
    return RestResponse::data(WhatsappBot::paginate());
  }

  public function store(Request $request)
  {
    $whatsapp_bot = new WhatsappBot();
    $whatsapp_bot->id = $request->get('id');
    $whatsapp_bot->session = $request->get('session');
    $whatsapp_bot->name = $request->get('name');
    $whatsapp_bot->save();
    return RestResponse::created($whatsapp_bot);
  }

  public function show(WhatsappBot $whatsapp_bot)
  {
    return RestResponse::data($whatsapp_bot);
  }

  public function update(Request $request, WhatsappBot $whatsapp_bot)
  {
    if ($request->exists('session')) $whatsapp_bot->session = $request->get('session');
    if ($request->exists('name')) $whatsapp_bot->name = $request->get('name');
    $whatsapp_bot->save();
    return RestResponse::updated($whatsapp_bot);
  }


  public function destroy(WhatsappBot $whatsapp_bot)
  {
    $whatsapp_bot->delete();
    return RestResponse::deleted($whatsapp_bot);
  }
}
