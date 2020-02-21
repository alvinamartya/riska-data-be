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
      Artisan::call('db:seed', ['--force' => true, '--class' => ProvinceSeeder::class]);
      Artisan::call('db:seed', ['--force' => true, '--class' => RegencySeeder::class]);
      Artisan::call('db:seed', ['--force' => true, '--class' => DistrictSeeder::class]);
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
