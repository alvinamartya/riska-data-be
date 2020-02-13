<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('districts', function (Blueprint $table) {
      $table->char('id', 7)->primary();
      $table->char('regency_id', 4)->index();
      $table->string('name', 200);

      $table->foreign('regency_id')->references('id')->on('regencies')->onDelete('restrict');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('districts');
  }
}
