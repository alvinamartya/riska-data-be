<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveAuditTrailFromSuggestionTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('suggestions', function (Blueprint $table) {
      $table->dropColumn(['created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('suggestions', function (Blueprint $table) {
      // Break backward compatibility
    });
  }
}
