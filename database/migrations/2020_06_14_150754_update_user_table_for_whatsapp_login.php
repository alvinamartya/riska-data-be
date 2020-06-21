<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserTableForWhatsappLogin extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('users', function (Blueprint $table) {
      $table->string('email', 50)->nullable()->change(); // break backward compatibility
      $table->index('email');
      $table->index('whatsapp_number');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('users', function (Blueprint $table) {
      $table->dropIndex('users_whatsapp_number_index');
      $table->dropIndex('users_email_index');
    });
  }
}
