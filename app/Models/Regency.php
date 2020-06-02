<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Regency
 *
 * @property int $id
 * @property string $province_id
 * @property string $name
 * @method static Builder|Regency newModelQuery()
 * @method static Builder|Regency newQuery()
 * @method static Builder|Regency query()
 * @method static Builder|Regency whereId($value)
 * @method static Builder|Regency whereName($value)
 * @method static Builder|Regency whereProvinceId($value)
 * @mixin Eloquent
 * @property-read Collection|District[] $districts
 * @property-read int|null $districts_count
 * @property-read Province $province
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
