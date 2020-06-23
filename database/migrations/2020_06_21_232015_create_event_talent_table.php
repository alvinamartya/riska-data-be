<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTalentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_talent', function (Blueprint $table) {
            $table->unsignedBigInteger('talent_id');
            $table->unsignedBigInteger('event_id');
            $table->string('notes');
            
            $table->foreign('talent_id')->references('id')->on('talents')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_talent');
    }
}
