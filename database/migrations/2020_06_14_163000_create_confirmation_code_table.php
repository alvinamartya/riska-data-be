<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfirmationCodeTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('confirmation_codes', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('action', 20)->index();
      $table->string('code', 6);
      $table->timestamp('expired_at');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('confirmation_codes');
  }
}
