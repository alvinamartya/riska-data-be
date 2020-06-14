<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;

class SeedBotUser extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    $user = new User();
    $user->fullname = "RISKA Tech";
    $user->whatsapp_number = "6281292803570";
    $user->provider_name = "whatsapp";
    $user->provider_id = "6281292803570@c.us";
    $user->save();
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   * @throws Exception
   */
  public function down()
  {
    User::whereWhatsappNumber("6281292803570")->delete();
  }
}
