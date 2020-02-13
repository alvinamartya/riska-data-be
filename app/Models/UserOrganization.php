<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\UserOrganization
 *
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrganization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrganization newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserOrganization onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrganization query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserOrganization withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserOrganization withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 */
class UserOrganization extends Model
{
  use SoftDeletes, Auditable;

  protected $hidden = [
    'created_at',
    'created_by',
    'updated_at',
    'updated_by',
    'deleted_at',
    'deleted_by',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
