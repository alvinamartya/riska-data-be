<?php

namespace App\Events;

use App\Models\Permission;
use Illuminate\Queue\SerializesModels;

class PermissionCreated
{
  use SerializesModels;

  public $permission;

  public function __construct(Permission $permission)
  {
    $this->permission = $permission;
  }
}
