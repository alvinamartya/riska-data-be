<?php

namespace App\Http\Controllers\v1;

use App\Constants\WhatsappInboxStatus;
use App\Constants\WhatsappMessageType;
use App\Constants\WhatsappOutboxStatus;
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
    return RestResponse::data($outboxes->paginate());
  }

  public function store(Request $request, WhatsappBot $whatsapp_bot)
  {
    $inbox = new WhatsappOutbox();
    $inbox->owner = $whatsapp_bot->id;
    $inbox->to = $request->get('to');
    $inbox->message = $request->get('message');
    $inbox->option = $request->get('optionx');
    $inbox->status = $request->get('status');
    $inbox->save();

    return RestResponse::created($inbox);
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
