<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('invoice', function (Blueprint $table) {
      $table->bigIncrements('id')->primary();
      $table->bigInteger('user_program_id');
      $table->string('code', 45);
      $table->date('invoice_date');
      $table->decimal('amount');
      $table->string('created_by', 100);
      $table->string('updated_by', 100)->nullable();
      $table->string('deleted_by', 100)->nullable();
      $table->timestamps();
      $table->softDeletes();
      
      $table->foreign('user_program_id')->references('id')->on('user_program')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('invoice');
  }
}
