<?php

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Database\Migrations\Migration;

class SeedGeolocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Artisan::call('db:seed', ['--class' => ProvinceSeeder::class]);
      Artisan::call('db:seed', ['--class' => RegencySeeder::class]);
      Artisan::call('db:seed', ['--class' => DistrictSeeder::class]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      District::truncate();
      Regency::truncate();
      Province::truncate();
    }
}
