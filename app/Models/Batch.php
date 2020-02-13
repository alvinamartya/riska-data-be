<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Batch
 *
 * @property int $id
 * @property string $name
 * @property string $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Batch onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Batch whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Batch withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Batch withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Program[] $programs
 * @property-read int|null $programs_count
 */
class Batch extends Model
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

  public function programs()
  {
    return $this->hasMany(Program::class);
  }
}
