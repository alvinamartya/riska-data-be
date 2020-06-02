<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Province
 *
 * @property int $id
 * @property string $name
 * @method static Builder|Province newModelQuery()
 * @method static Builder|Province newQuery()
 * @method static Builder|Province query()
 * @method static Builder|Province whereId($value)
 * @method static Builder|Province whereName($value)
 * @mixin Eloquent
 * @property-read Collection|Regency[] $regencies
 * @property-read int|null $regencies_count
 */
class Province extends Model
{
  public $timestamps = false;

  public function regencies()
  {
    return $this->hasMany(Regency::class);
  }
}
