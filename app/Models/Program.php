<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|Program newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Program newQuery()
 * @method static Builder|Program onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Program query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereBatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereContactPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereFemaleQuote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereMaleQuote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereTotalQuota($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereUpdatedBy($value)
 * @method static Builder|Program withTrashed()
 * @method static Builder|Program withoutTrashed()
 * @mixin Eloquent
 * @property-read Batch $batch
 * @property-read Department $department
 * @property-read Collection|UserProgram[] $participants
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
