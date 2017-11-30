<?php

use Faker\Generator as Faker;

$factory->define(\App\Event::class, function (Faker $faker) {
    return [
        'event_type_id'   => rand(1,3),
        'place_id'        => rand(1,2),
        'name'            => $faker->word,
        'description'     => $faker->paragraph,
        'image_cover'     => $faker->imageUrl(1600,500),
        'image_thumbnail' => $faker->imageUrl(1600,500),
        'date'            => $faker->dateTime
    ];
});
