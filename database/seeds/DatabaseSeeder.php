<?php

use ProvinceSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call([
        ProvinceSeeder::class,
        RegencySeeder::class,
        DistrictSeeder::class,
    ]);
  }
}
