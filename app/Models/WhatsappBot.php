<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\WhatsappBot
 *
 * @property string $id
 * @property string $name
 * @property mixed|null $session
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|WhatsappInbox[] $inboxes
 * @property-read int|null $inboxes_count
 * @property-read Collection|WhatsappOutbox[] $outboxes
 * @property-read int|null $outboxes_count
 * @method static Builder|WhatsappBot newModelQuery()
 * @method static Builder|WhatsappBot newQuery()
 * @method static Builder|WhatsappBot query()
 * @method static Builder|WhatsappBot whereCreatedAt($value)
 * @method static Builder|WhatsappBot whereId($value)
 * @method static Builder|WhatsappBot whereName($value)
 * @method static Builder|WhatsappBot whereSession($value)
 * @method static Builder|WhatsappBot whereUpdatedAt($value)
 * @mixin Eloquent
 */
class WhatsappBot extends Model
{
  protected $hidden = [
    'created_at',
    'updated_at',
  ];

  protected $casts = [
    'session' => 'json'
  ];

  public function inboxes()
  {
    return $this->hasMany(WhatsappInbox::class, "owner", "id");
  }

  public function outboxes()
  {
    return $this->hasMany(WhatsappOutbox::class, "owner", "id");
  }
}
