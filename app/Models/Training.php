<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\Training
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|Training newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Training newQuery()
 * @method static Builder|Training onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Training query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Training whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Training whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Training whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Training whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Training whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Training whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Training whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Training whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Training whereUpdatedBy($value)
 * @method static Builder|Training withTrashed()
 * @method static Builder|Training withoutTrashed()
 * @mixin Eloquent
 * @property-read Collection|User[] $participants
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
