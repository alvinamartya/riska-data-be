<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProgram newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProgram newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserProgram onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProgram query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProgram whereAdditionalData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProgram whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProgram whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProgram whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProgram whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProgram whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProgram whereIsGraduated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProgram whereProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProgram whereRegistrationStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProgram whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProgram whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProgram whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserProgram withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserProgram withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Invoice[] $invoices
 * @property-read int|null $invoices_count
 * @property-read \App\Models\Program $program
 * @property-read \App\Models\User $user
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
