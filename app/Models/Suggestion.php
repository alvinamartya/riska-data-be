<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\Suggestion
 *
 * @property int $id
 * @property string $group
 * @property string $item
 * @property string|null $display_text
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_by
 * @property string|null $created_by
 * @property string|null $updated_by
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|Suggestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Suggestion newQuery()
 * @method static Builder|Suggestion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Suggestion query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Suggestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Suggestion whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Suggestion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Suggestion whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Suggestion whereDisplayText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Suggestion whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Suggestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Suggestion whereItem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Suggestion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Suggestion whereUpdatedBy($value)
 * @method static Builder|Suggestion withTrashed()
 * @method static Builder|Suggestion withoutTrashed()
 * @mixin Eloquent
 */
class Suggestion extends Model
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
}
