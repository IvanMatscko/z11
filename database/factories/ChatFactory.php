<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Chat;
use Faker\Generator as Faker;

$factory->define(Chat::class, function (Faker $faker) {
    return [
        'login' => $faker->userName,
        'email' => $faker->email,
        'message' => $faker->sentence,
    ];
});
