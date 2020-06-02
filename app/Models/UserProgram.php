<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\UserProgram
 *
 * @property int $id
 * @property int $program_id
 * @property int $user_id
 * @property int $registration_status
 * @property int|null $is_graduated
 * @property string $additional_data
 * @property string $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProgram newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProgram newQuery()
 * @method static Builder|UserProgram onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProgram query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProgram whereAdditionalData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProgram whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProgram whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProgram whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProgram whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProgram whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProgram whereIsGraduated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProgram whereProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProgram whereRegistrationStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProgram whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProgram whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProgram whereUserId($value)
 * @method static Builder|UserProgram withTrashed()
 * @method static Builder|UserProgram withoutTrashed()
 * @mixin Eloquent
 * @property-read Collection|Invoice[] $invoices
 * @property-read int|null $invoices_count
 * @property-read Program $program
 * @property-read User $user
 */
class UserProgram extends Model
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

  public function program()
  {
    return $this->belongsTo(Program::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function invoices()
  {
    return $this->hasMany(Invoice::class);
  }
}
