<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('permissions', function (Blueprint $table) {
      $table->smallIncrements('id');
      $table->string('name', 100)->unique();
      $table->string('description');
    });

    Schema::create('permission_role', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->unsignedSmallInteger('role_id');
      $table->unsignedSmallInteger('permission_id');

      $table->index(['role_id', 'permission_id']);
      $table->unique(['role_id', 'permission_id']);

      $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
      $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('permission_role');
    Schema::dropIfExists('permissions');
  }
}
