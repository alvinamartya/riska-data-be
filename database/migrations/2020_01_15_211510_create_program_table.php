<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program', function (Blueprint $table) {
            $table->bigIncrements('id')->primary();
            $table->bigInteger('department_id');
            $table->bigInteger('batch_id');
            $table->string('name', 100);
            $table->text('description');
            $table->json('contact_person')->nullable();
            $table->integer('fee')->unsigned();
            $table->smallInteger('total_quota');
            $table->smallInteger('male_quote');
            $table->smallInteger('female_quote');
            $table->boolean('is_active')->nullable();
            $table->string('created_by', 100);
            $table->string('updated_by', 100)->nullable();
            $table->string('deleted_by', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('program_id')->references('id')->on('program')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program');
    }
}
