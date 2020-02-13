<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Training
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Training onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Training whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Training withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Training withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $participants
 * @property-read int|null $participants_count
 */
class Training extends Model
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

  public function participants()
  {
    return $this->belongsToMany(User::class);
  }
}
