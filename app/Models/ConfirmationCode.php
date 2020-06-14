<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ConfirmationCode
 *
 * @property int $id
 * @property string $action
 * @property string $code
 * @property string $expired_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConfirmationCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConfirmationCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConfirmationCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConfirmationCode whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConfirmationCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConfirmationCode whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConfirmationCode whereId($value)
 * @mixin \Eloquent
 */
class ConfirmationCode extends Model
{
  public $timestamps = false;

  public static function createCode($action)
  {
    $i = 0;
    $pin = "";
    while ($i < 6) {
      $pin .= mt_rand(0, 9);
      $i++;
    }

    $confirmationCode = ConfirmationCode::whereAction($action)->first();
    if (!$confirmationCode) $confirmationCode = new ConfirmationCode();
    $confirmationCode->action = $action;
    $confirmationCode->code = $pin;
    $confirmationCode->expired_at = Carbon::now()->addMinutes(30);
    $confirmationCode->save();

    return $pin;
  }

  public static function isCodeMatch($action, $code)
  {
    $confirmationCode = ConfirmationCode::whereAction($action)->first();
    if (!$confirmationCode) return false;
    if ($confirmationCode->expired_at <= Carbon::now()) {
      $confirmationCode->delete();
      return false;
    }
    return $confirmationCode->code == $code;
  }

  public static function remove($action)
  {
    $confirmationCode = ConfirmationCode::whereAction($action)->first();
    if ($confirmationCode) $confirmationCode->delete();
  }
}
