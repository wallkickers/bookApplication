<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'code' => $faker->company,
        'name' => $faker->name,
        'created_at' => null,
        'updated_at' => null,
    ];
});
