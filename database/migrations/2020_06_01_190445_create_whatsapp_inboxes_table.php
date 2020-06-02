<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhatsappInboxesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('whatsapp_inboxes', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('owner', 20);
      $table->string('from', 35);
      $table->string('sender_id', 15);
      $table->string('sender_name', 15);
      $table->string('group', 20);
      $table->text('message');
      $table->string('status');
      $table->timestamps();

      $table->foreign('owner')->references('id')->on('whatsapp_bots')->onDelete('restrict')->onUpdate('cascade');
      $table->index(["owner", "status"]);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('whatsapp_inboxes');
  }
}
