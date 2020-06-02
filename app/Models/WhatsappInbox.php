<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\WhatsappInbox
 *
 * @property int $id
 * @property WhatsappBot $owner
 * @property string $from
 * @property string $sender_id
 * @property string $sender_name
 * @property string $group
 * @property string $message
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|WhatsappInbox newModelQuery()
 * @method static Builder|WhatsappInbox newQuery()
 * @method static Builder|WhatsappInbox query()
 * @method static Builder|WhatsappInbox whereCreatedAt($value)
 * @method static Builder|WhatsappInbox whereFrom($value)
 * @method static Builder|WhatsappInbox whereGroup($value)
 * @method static Builder|WhatsappInbox whereId($value)
 * @method static Builder|WhatsappInbox whereMessage($value)
 * @method static Builder|WhatsappInbox whereOwner($value)
 * @method static Builder|WhatsappInbox whereSenderId($value)
 * @method static Builder|WhatsappInbox whereSenderName($value)
 * @method static Builder|WhatsappInbox whereStatus($value)
 * @method static Builder|WhatsappInbox whereUpdatedAt($value)
 * @mixin Eloquent
 */
class WhatsappInbox extends Model
{
  protected $hidden = [
    'created_at',
    'updated_at',
  ];

  public function owner()
  {
    return $this->belongsTo(WhatsappBot::class, "owner", "id");
  }
}
