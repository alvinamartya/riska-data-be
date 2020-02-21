<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;

class SeedSuperadminRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      $role = new Role;
      $role->name = "Super Admin";
      $role->description = "Role ini dapat mengakses seluruh fitur aplikasi";
      $role->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Role::truncate();
    }
}
