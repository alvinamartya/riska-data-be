<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;


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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvent newQuery()
 * @method static Builder|UserEvent onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvent query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvent whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvent whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvent whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvent whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvent whereIsInternal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvent whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvent whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvent whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvent whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserEvent whereYear($value)
 * @method static Builder|UserEvent withTrashed()
 * @method static Builder|UserEvent withoutTrashed()
 * @mixin Eloquent
 * @property-read User $user
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

  protected $casts = [
    'is_internal' => 'boolean'
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }


}
