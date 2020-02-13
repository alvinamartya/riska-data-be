<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\UserEvent
 *
 * @property int $id
 * @property int $user_id
 * @property int $year
 * @property string $name
 * @property string $role
 * @property string|null $description
 * @property int $is_internal
 * @property string $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEvent newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserEvent onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEvent query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEvent whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEvent whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEvent whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEvent whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEvent whereIsInternal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEvent whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEvent whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEvent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEvent whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEvent whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEvent whereYear($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserEvent withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserEvent withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 */
class UserEvent extends Model
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
