<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\District
 *
 * @property int $id
 * @property string $regency_id
 * @property string $name
 * @method static Builder|District newModelQuery()
 * @method static Builder|District newQuery()
 * @method static Builder|District query()
 * @method static Builder|District whereId($value)
 * @method static Builder|District whereName($value)
 * @method static Builder|District whereRegencyId($value)
 * @mixin Eloquent
 * @property-read Regency $regency
 */
class District extends Model
{
  public $timestamps = false;

  public function regency()
  {
    return $this->belongsTo(Regency::class);
  }
}
