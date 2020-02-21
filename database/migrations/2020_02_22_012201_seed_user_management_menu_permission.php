<?php

use App\Models\Permission;
use Illuminate\Database\Migrations\Migration;

class SeedUserManagementMenuPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      $permission = new Permission;
      $permission->name = "menu:usermgmt";
      $permission->description = "Menampilkan menu user management";
      $permission->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     * @throws Exception
     */
    public function down()
    {
      Permission::whereName('menu:usermgmt')->delete();
    }
}
