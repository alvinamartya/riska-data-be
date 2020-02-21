<?php

namespace App\Listeners;

use App\Events\PermissionCreated;
use App\Models\Role;

class AttachRoleToSuperAdmin
{
  /**
   * Handle the event.
   *
   * @param  \App\Events\PermissionCreated $event
   * @return void
   */
  public function handle(PermissionCreated $event)
  {
    Role::whereId(1)->first()->permissions()->attach($event->permission->id);
  }
}