<?php

namespace App\Models;

use App\Events\PermissionCreated;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Permission
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property-read Collection|Role[] $roles
 * @property-read int|null $roles_count
 * @method static Builder|Permission newModelQuery()
 * @method static Builder|Permission newQuery()
 * @method static Builder|Permission query()
 * @method static Builder|Permission whereDescription($value)
 * @method static Builder|Permission whereId($value)
 * @method static Builder|Permission whereName($value)
 * @mixin Eloquent
 */
class Permission extends Model
{
  public $timestamps = false;

  protected $dispatchesEvents = [
    'created' => PermissionCreated::class,
  ];

  public function roles()
  {
    return $this->belongsToMany(Role::class);
  }
}
