<?php

use Faker\Generator as Faker;

$factory->define(\App\Area::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'place_id' => rand(1,6),
        'capacity' => rand(1,100),
    ];
});
