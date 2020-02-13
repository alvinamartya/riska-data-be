<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Payment
 *
 * @property int $id
 * @property int $invoice_id
 * @property string $payment_type
 * @property float $amount
 * @property string|null $payment_proof
 * @property string|null $payment_date
 * @property string|null $description
 * @property int|null $approval_status
 * @property string|null $approval_date
 * @property string|null $approval_user_id
 * @property string $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Payment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereApprovalDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereApprovalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereApprovalUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePaymentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePaymentProof($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Payment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Payment withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\User $approvedBy
 * @property-read \App\Models\Invoice $invoice
 */
class Payment extends Model
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

  public function invoice()
  {
    return $this->belongsTo(Invoice::class);
  }

  public function approvedBy()
  {
    return $this->hasOne(User::class, 'approval_user_id');
  }
}
