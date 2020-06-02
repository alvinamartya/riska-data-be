<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhatsappOutboxesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('whatsapp_outboxes', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('owner', 20);
      $table->string('to', 35);
      $table->text('message');
      $table->json('option')->nullable();
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
    Schema::dropIfExists('whatsapp_outboxes');
  }
}
