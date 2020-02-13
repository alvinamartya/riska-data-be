<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Invoice
 *
 * @property int $id
 * @property int $user_program_id
 * @property string $code
 * @property string $invoice_date
 * @property float $amount
 * @property string $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Invoice onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereInvoiceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereUserProgramId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Invoice withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Invoice withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Payment[] $payments
 * @property-read int|null $payments_count
 * @property-read \App\Models\UserProgram $userProgram
 */
class Invoice extends Model
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

  public function userProgram()
  {
    return $this->belongsTo(UserProgram::class);
  }

  public function payments()
  {
    return $this->hasMany(Payment::class);
  }
}
