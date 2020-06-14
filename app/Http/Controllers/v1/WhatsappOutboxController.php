<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\RestResponse;
use App\Models\WhatsappBot;
use App\Models\WhatsappOutbox;
use Illuminate\Http\Request;

class WhatsappOutboxController extends Controller
{

  public function index(WhatsappBot $whatsapp_bot, Request $request)
  {
    $outboxes = $whatsapp_bot->outboxes();
    if ($request->get('status') != null) {
      $outboxes = $outboxes->where('status', '=', $request->get('status'));
    }
    return RestResponse::data($outboxes->orderBy('created_at', 'desc')->paginate());
  }

  public function store(Request $request, WhatsappBot $whatsapp_bot)
  {
    $outbox = new WhatsappOutbox();
    $outbox->owner = $whatsapp_bot->id;
    $outbox->to = $request->get('to');
    $outbox->message = $request->get('message');
    $outbox->option = $request->get('option');
    $outbox->status = $request->get('status');
    $outbox->save();

    return RestResponse::created($outbox);
  }

  public function show(WhatsappBot $whatsapp_bot, WhatsappOutbox $outbox)
  {
    if ($outbox->owner != $whatsapp_bot->id) {
      return RestResponse::unauthorized();
    }
    return RestResponse::data($outbox);
  }

  public function update(Request $request, WhatsappBot $whatsapp_bot, WhatsappOutbox $outbox)
  {
    if ($outbox->owner != $whatsapp_bot->id) {
      return RestResponse::unauthorized();
    }
    $outbox->status = $request->get('status');
    $outbox->save();
    return RestResponse::updated($outbox);
  }


  public function destroy(WhatsappBot $whatsapp_bot, WhatsappOutbox $outbox)
  {
    if ($outbox->owner != $whatsapp_bot->id) {
      return RestResponse::unauthorized();
    }
    $outbox->delete();
    return RestResponse::deleted($outbox);
  }
}
