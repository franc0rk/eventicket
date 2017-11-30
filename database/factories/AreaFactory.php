<?php

use Faker\Generator as Faker;

$factory->define(\App\Area::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'place_id' => rand(1,2),
        'capacity' => rand(1,100),
        'price'    => rand(1000,2000),
    ];
});
