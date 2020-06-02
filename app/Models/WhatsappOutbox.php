<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\WhatsappOutbox
 *
 * @property int $id
 * @property WhatsappBot $owner
 * @property string $to
 * @property string $message
 * @property mixed|null $option
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|WhatsappOutbox newModelQuery()
 * @method static Builder|WhatsappOutbox newQuery()
 * @method static Builder|WhatsappOutbox query()
 * @method static Builder|WhatsappOutbox whereCreatedAt($value)
 * @method static Builder|WhatsappOutbox whereId($value)
 * @method static Builder|WhatsappOutbox whereMessage($value)
 * @method static Builder|WhatsappOutbox whereOption($value)
 * @method static Builder|WhatsappOutbox whereOwner($value)
 * @method static Builder|WhatsappOutbox whereStatus($value)
 * @method static Builder|WhatsappOutbox whereTo($value)
 * @method static Builder|WhatsappOutbox whereUpdatedAt($value)
 * @mixin Eloquent
 */
class WhatsappOutbox extends Model
{
  protected $hidden = [
    'created_at',
    'updated_at',
  ];

  protected $casts = [
    'option' => 'json'
  ];

  public function owner()
  {
    return $this->belongsTo(WhatsappBot::class, "owner", "id");
  }
}
