<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Department
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Department onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Department withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Department withoutTrashed()
 * @mixin \Eloquent
 */
class Department extends Model
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
}
