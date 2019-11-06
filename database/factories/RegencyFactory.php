<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Regency;
use Faker\Generator as Faker;

$factory->define(Regency::class, function (Faker $faker) {
    return [
        'name'  => $faker->name,
        'province_id' => rand(11, 19)
    ];
});
