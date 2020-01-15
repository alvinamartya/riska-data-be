<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('invoice_id')->unsigned();
            $table->string('payment_type', 100);
            $table->decimal('amount');
            $table->string('payment_proof', 255)->nullable();
            $table->date('payment_date')->nullable();
            $table->string('description', 255)->nullable();
            $table->boolean('approval_status')->nullable();
            $table->date('approval_date')->nullable();
            $table->string('approval_user_id', 100)->nullable();
            $table->date('created_at');
            $table->string('created_by', 100);
            $table->date('updated_at')->nullable();
            $table->string('updated_by', 100)->nullable();
      
            $table->foreign('invoice_id')->references('id')->on('invoice')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment');
    }
}
