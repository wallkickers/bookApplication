<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory\Generator $factory */
use App\Admin;
use Faker\Generator as Faker;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        // 'id' => ,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => null,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => null,
        'created_at' => now(),
        'updated_at' => null,
        // 'company_id' =>,
    ];
});
