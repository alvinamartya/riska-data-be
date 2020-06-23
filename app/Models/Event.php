<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Event
 *
 * @property int $id
 * @property string $name
 * @property string $date
 * @property mixed|null $labels
 * @property string $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Talent[] $talents
 * @property-read int|null $talents_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereLabels($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event withoutTrashed()
 * @mixin \Eloquent
 */
class Event extends Model
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

  public function talents()
  {
    return $this->belongsToMany(Talent::class)->withPivot(['notes']);
  }
}
