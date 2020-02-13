<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Province
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Province newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Province newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Province query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Province whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Province whereName($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Regency[] $regencies
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
