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
 * @property int $id
 * @property int $user_id
 * @property int $year
 * @property string $name
 * @property string $role
 * @property string|null $description
 * @property string $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrganization whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrganization whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrganization whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrganization whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrganization whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrganization whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrganization whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrganization whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrganization whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrganization whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrganization whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOrganization whereYear($value)
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
