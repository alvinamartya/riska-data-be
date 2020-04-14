<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\RestResponse;
use App\Models\User;
use App\Models\UserEvent;
use Illuminate\Http\Request;

class UserEventController extends Controller
{
  public function index(User $user)
  {
    return RestResponse::data($user->events);
  }

  public function show(User $user, UserEvent $event)
  {

    if ($event->user_id != $user->id) {
      return RestResponse::unauthorized();
    }

    return RestResponse::data($event);
  }

  public function store(Request $request, User $user)
  {
    $event = new UserEvent();
    $event->user_id = $user->id;
    $event->year = $request->year;
    $event->name = $request->name;
    $event->role = $request->role;
    $event->description = $request->description;
    $event->is_internal = $request->is_internal;
    $event->save();
    return RestResponse::created(UserEvent::class);
  }

  public function update(Request $request, User $user, UserEvent $event)
  {
    if ($event->user_id != $user->id) {
      return RestResponse::unauthorized();
    }

    $event->year = $request->year;
    $event->name = $request->name;
    $event->role = $request->role;
    $event->description = $request->description;
    $event->is_internal = $request->is_internal;
    $event->save();
    return RestResponse::updated(UserEvent::class);

  }

  public function destroy(User $user, UserEvent $event)
  {
    if ($event->user_id != $user->id) {
      return RestResponse::unauthorized();
    }

    $event->delete();
    return RestResponse::deleted(UserEvent::class);
  }
}
