<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('trainings', function (Blueprint $table) {
      $table->smallIncrements('id');
      $table->string('name', 155);
      $table->text('description')->nullable();
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
    Schema::dropIfExists('trainings');
  }
}
