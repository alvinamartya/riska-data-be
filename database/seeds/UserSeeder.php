<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $user = new User;
    $user->nickname = "admin";
    $user->fullname = "IT RISKA";
    $user->email = "it.riskaorid@gmail.com";
    $user->provider_name = "google";
    $user->save();

    $permission = new Permission;
    $permission->name = "menu:usermgmt";
    $permission->description = "Menampilkan menu user management";
    $permission->save();

    $role = new Role;
    $role->name = "Super Admin";
    $role->description = "Role ini dapat mengakses seluruh fitur aplikasi";
    $role->save();

    $role->users()->attach($user->id, ['is_active' => true, 'expired_at' => null]);
    $role->permissions()->attach($permission->id);
  }
}
