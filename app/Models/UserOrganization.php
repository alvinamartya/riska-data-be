<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\UserOrganization
 *
 * @method static bool|null forceDelete()
 * @method static Builder|UserOrganization newModelQuery()
 * @method static Builder|UserOrganization newQuery()
 * @method static \Illuminate\Database\Query\Builder|UserOrganization onlyTrashed()
 * @method static Builder|UserOrganization query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|UserOrganization withTrashed()
 * @method static \Illuminate\Database\Query\Builder|UserOrganization withoutTrashed()
 * @mixin Eloquent
 * @property-read User $user
 * @property int $id
 * @property int $user_id
 * @property int $year
 * @property string $name
 * @property string $role
 * @property string|null $description
 * @property string $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder|UserOrganization whereCreatedAt($value)
 * @method static Builder|UserOrganization whereCreatedBy($value)
 * @method static Builder|UserOrganization whereDeletedAt($value)
 * @method static Builder|UserOrganization whereDeletedBy($value)
 * @method static Builder|UserOrganization whereDescription($value)
 * @method static Builder|UserOrganization whereId($value)
 * @method static Builder|UserOrganization whereName($value)
 * @method static Builder|UserOrganization whereRole($value)
 * @method static Builder|UserOrganization whereUpdatedAt($value)
 * @method static Builder|UserOrganization whereUpdatedBy($value)
 * @method static Builder|UserOrganization whereUserId($value)
 * @method static Builder|UserOrganization whereYear($value)
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
