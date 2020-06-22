<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Batch
 *
 * @property int $id
 * @property string $name
 * @property string $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static Builder|Batch newModelQuery()
 * @method static Builder|Batch newQuery()
 * @method static \Illuminate\Database\Query\Builder|Batch onlyTrashed()
 * @method static Builder|Batch query()
 * @method static bool|null restore()
 * @method static Builder|Batch whereCreatedAt($value)
 * @method static Builder|Batch whereCreatedBy($value)
 * @method static Builder|Batch whereDeletedAt($value)
 * @method static Builder|Batch whereDeletedBy($value)
 * @method static Builder|Batch whereId($value)
 * @method static Builder|Batch whereName($value)
 * @method static Builder|Batch whereUpdatedAt($value)
 * @method static Builder|Batch whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|Batch withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Batch withoutTrashed()
 * @mixin Eloquent
 * @property-read Collection|Program[] $programs
 * @property-read int|null $programs_count
 * @property string $start_date
 * @property string $end_date
 * @method static Builder|Batch whereEndDate($value)
 * @method static Builder|Batch whereStartDate($value)
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
