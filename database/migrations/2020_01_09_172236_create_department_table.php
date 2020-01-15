<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('department', function (Blueprint $table) {
      $table->bigIncrements('id')->primary();
      $table->string('code', 10);
      $table->string('name', 100); 
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
    Schema::dropIfExists('department');
  }
}
