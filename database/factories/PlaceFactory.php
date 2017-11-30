<?php

use Faker\Generator as Faker;

$factory->define(\App\Place::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        'image' => $faker->imageUrl(670, 410),
        'address' => $faker->address,
        'state_id' => rand(1,2),
    ];
});
