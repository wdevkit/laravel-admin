<?php

use \Faker\Generator;
use Illuminate\Support\Str;
use Wdevkit\Admin\Models\Admin;

/* @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Admin::class, function (Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'api_token' => Str::random(80),
    ];
});
