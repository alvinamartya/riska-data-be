<?php

use App\Department;
use Illuminate\Database\Seeder;

class DepartementsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Department::create(['short_name' => 'SDTNI', 'name' => 'Studi Dasar Terpadu Nilai Islam']);
    Department::create(['short_name' => 'SDIS', 'name' => 'Studi Dasar Islam Siswa']);
    Department::create(['short_name' => 'BMAQ', 'name' => 'Belajar Mahir Al-Quran']);
    Department::create(['short_name' => 'SC', 'name' => 'Sister Club Academy']);
  }
}
