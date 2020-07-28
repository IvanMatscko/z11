<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\News;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {
    return [
        'chanel_id' => null,
        'post_id' => News::all()->count() > 0 ? News::all()->random(1)->id : null,
        'content' => $faker->sentence,
        'views' => rand(0, 10000),
        'active' => rand(0,1),
        'post_created' => $faker->unixTime(),
        'source' => rand(0,1) ? 'tg' : 'tw',
        'locale' => rand(0,1) ? 'ru' : 'en',
        'game' => rand(0,1) ? 'dota' : 'cs',
    ];
});
