<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('nickname', 30)->nullable();
      $table->string('fullname', 100);
      $table->string('photo')->nullable();
      $table->tinyInteger('gender')->nullable();
      $table->string('phone_number', 20)->nullable();
      $table->string('whatsapp_number', 20)->nullable();
      $table->string('address')->nullable();
      $table->string('birth_place', 100)->nullable();
      $table->date('birth_date')->nullable();
      $table->json('social_media')->nullable();
      $table->string('education_grade', 50)->nullable();
      $table->string('education_subject', 100)->nullable();
      $table->string('field_of_work', 100)->nullable();
      $table->string('status', 30)->nullable();
      $table->string('email', 50)->unique();
      $table->string('provider_name', 10)->nullable();
      $table->string('provider_id', 100)->nullable();
      $table->string('created_by', 100)->nullable();
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
    Schema::dropIfExists('users');
  }
}
