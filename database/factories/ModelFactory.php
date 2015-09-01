<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Poolarna\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => Hash::make('str_random(10)'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(Poolarna\Event::class, function ($faker) {
    return [
        'name' => $faker->city,
        'description' => $faker->paragraph($nbSentences = 3),
        'availability' => $faker->randomDigit,
        'event_date' => $faker->date,
        'event_time' => $faker->time,
        'event_place' => $faker->streetAddress,
        'user_id' => 1,
    ];
});

$factory->define(Poolarna\Participant::class, function ($faker) {
    return [
        'event_id' => $faker->randomDigit,
        'user_id' => $faker->randomDigitNotNull,
    ];
});
