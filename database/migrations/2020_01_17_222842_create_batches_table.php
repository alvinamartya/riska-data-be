<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('batches', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('name', 100);
      $table->date('start_date');
      $table->date('end_date');
      $table->string('created_by', 100);
      $table->string('updated_by', 100)->nullable();
      $table->string('deleted_by', 100)->nullable();
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('batches');
  }
}
