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
 */
class Regency extends Model
{
    protected $table = 'regency';
    public $timestamps = false;
}
