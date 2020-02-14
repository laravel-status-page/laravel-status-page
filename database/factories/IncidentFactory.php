<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Incident;
use Faker\Generator as Faker;
use App\Models\User;

$factory->define(Incident::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'name' => $faker->name,
        'status' => $faker->randomElement(
            array_keys(config('laravel-status-page.incident-statuses'))
        ),
        'occurred_at' => $faker->dateTimeThisMonth()
    ];
});
