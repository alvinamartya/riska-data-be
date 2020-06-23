<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Talent
 *
 * @property int $id
 * @property string $name
 * @property string $phone_number
 * @property string $email
 * @property string $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 * @property-read int|null $events_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Talent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Talent newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Talent onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Talent query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Talent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Talent whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Talent whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Talent whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Talent whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Talent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Talent whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Talent wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Talent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Talent whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Talent withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Talent withoutTrashed()
 * @mixin \Eloquent
 */
class Talent extends Model
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

  public function events()
  {
    return $this->belongsToMany(Event::class)->withPivot(['notes']);
  }
}
