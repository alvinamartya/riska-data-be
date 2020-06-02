<?php

namespace App\Http\Controllers\v1;

use App\Constants\WhatsappInboxStatus;
use App\Constants\WhatsappMessageType;
use App\Http\Controllers\Controller;
use App\Http\RestResponse;
use App\Models\WhatsappBot;
use App\Models\WhatsappInbox;
use Illuminate\Http\Request;

class WhatsappInboxController extends Controller
{

  public function index(WhatsappBot $whatsapp_bot)
  {
    return RestResponse::data($whatsapp_bot->inboxes()->orderBy('created_at', 'desc')->paginate());
  }

  public function store(Request $request, WhatsappBot $whatsapp_bot)
  {
    $inbox = new WhatsappInbox();
    $inbox->owner = $whatsapp_bot->id;
    $inbox->from = $request->get('from');
    $inbox->sender_id = $request->get('sender_id');
    $inbox->sender_name = $request->get('sender_name');
    $inbox->group = $request->get('group') ?: WhatsappMessageType::PERSONAL_CHAT;
    $inbox->message = $request->get('message');
    $inbox->status = WhatsappInboxStatus::UNREAD;
    $inbox->save();

    return RestResponse::created($inbox);
  }

  public function show(WhatsappBot $whatsapp_bot, WhatsappInbox $inbox)
  {
    if ($inbox->owner != $whatsapp_bot->id) {
      return RestResponse::unauthorized();
    }
    return RestResponse::data($inbox);
  }

  public function update(Request $request, WhatsappBot $whatsapp_bot, WhatsappInbox $inbox)
  {
    if ($inbox->owner != $whatsapp_bot->id) {
      return RestResponse::unauthorized();
    }
    $inbox->status = $request->get('status');
    $inbox->save();
    return RestResponse::updated($inbox);
  }


  public function destroy(WhatsappBot $whatsapp_bot, WhatsappInbox $inbox)
  {
    if ($inbox->owner != $whatsapp_bot->id) {
      return RestResponse::unauthorized();
    }
    $inbox->delete();
    return RestResponse::deleted($inbox);
  }
}
