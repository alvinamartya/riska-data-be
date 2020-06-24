<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Suggestion
 *
 * @property int $id
 * @property string $group
 * @property string $item
 * @property string|null $display_text
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Suggestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Suggestion newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Suggestion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Suggestion query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Suggestion whereDisplayText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Suggestion whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Suggestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Suggestion whereItem($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Suggestion withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Suggestion withoutTrashed()
 * @mixin \Eloquent
 */
class Suggestion extends Model
{

}
