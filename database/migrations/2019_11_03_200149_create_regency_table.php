<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegencyTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('regencies', function (Blueprint $table) {
      $table->char('id', 4)->primary();
      $table->char('province_id', 2)->index();
      $table->string('name', 200);

      $table->foreign('province_id')->references('id')->on('provinces')->onDelete('restrict');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('regencies');
  }
}
