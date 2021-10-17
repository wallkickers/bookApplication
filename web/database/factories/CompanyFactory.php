<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory\Generator $factory */
use App\Company;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Company::class, function (Faker $faker) {
    return [
        // 'id' => ,
        'code' => Str::random(5),
        'name' => $faker->name . '社',
        'created_at' => now(),
        'updated_at' => null,
    ];
});
