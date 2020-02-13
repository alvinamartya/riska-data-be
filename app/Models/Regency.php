<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Regency
 *
 * @property int $id
 * @property string $province_id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Regency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Regency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Regency query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Regency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Regency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Regency whereProvinceId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\District[] $districts
 * @property-read int|null $districts_count
 * @property-read \App\Models\Province $province
 */
class Regency extends Model
{
  public $timestamps = false;

  public function province()
  {
    return $this->belongsTo(Province::class);
  }

  public function districts()
  {
    return $this->hasMany(District::class);
  }
}
