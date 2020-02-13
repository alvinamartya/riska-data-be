<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Program
 *
 * @property int $id
 * @property int $department_id
 * @property int $batch_id
 * @property string $name
 * @property string $description
 * @property mixed|null $contact_person
 * @property int $fee
 * @property int $total_quota
 * @property int $male_quote
 * @property int $female_quote
 * @property int|null $is_active
 * @property string $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Program newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Program newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Program onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Program query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Program whereBatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Program whereContactPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Program whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Program whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Program whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Program whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Program whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Program whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Program whereFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Program whereFemaleQuote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Program whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Program whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Program whereMaleQuote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Program whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Program whereTotalQuota($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Program whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Program whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Program withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Program withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\Batch $batch
 * @property-read \App\Models\Department $department
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserProgram[] $participants
 * @property-read int|null $participants_count
 */
class Program extends Model
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

  public function batch()
  {
    return $this->belongsTo(Batch::class);
  }

  public function department()
  {
    return $this->belongsTo(Department::class);
  }

  public function participants()
  {
    return $this->hasMany(UserProgram::class);
  }
}
