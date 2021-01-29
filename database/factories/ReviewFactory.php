<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Review::class, function (Faker $faker) {
    return [
        //
        'id' => Str::uuid(),
        'rating' => random_int(1, 5),
        'content' => $faker->sentence()
    ];
});
