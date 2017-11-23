<?php

use Faker\Generator as Faker;

$factory->define(\App\Event::class, function (Faker $faker) {
    return [
        'event_type_id'   => rand(1,3),
        'place_id'        => rand(1,6),
        'name'            => $faker->word,
        'description'     => $faker->paragraph,
        'image_cover'     => $faker->imageUrl(),
        'image_thumbnail' => $faker->imageUrl(200,200),
        'date'            => $faker->dateTime
    ];
});
