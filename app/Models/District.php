<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\District
 *
 * @property int $id
 * @property string $regency_id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereRegencyId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Regency $regency
 */
class District extends Model
{
  public $timestamps = false;

  public function regency()
  {
    return $this->belongsTo(Regency::class);
  }
}
