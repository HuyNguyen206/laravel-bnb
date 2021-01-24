<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bookable;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$suffix = [
    'Premium Villa',
    'Gold Villa'.
    'Silver Room',
    'Deluxe Villa',
    'Medium House',
    'Brozen Villa',
    'Titanium Room'
];
$factory->define(Bookable::class, function (Faker $faker) use($suffix) {
    return [
        //
        'title' => $faker->city.' '.Arr::random($suffix),
        'description' => $faker->text()
    ];
});
