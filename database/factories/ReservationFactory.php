<?php

use Faker\Generator as Faker;

$factory->define(\App\Reservation::class, function (Faker $faker) {
    return [
        'user_id' => rand(1, 11),
        'event_id' => rand(1,2),
        'tickets'  => rand(1,5),
        'expiration' => $faker->dateTime(),
    ];
});
