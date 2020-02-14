<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\IncidentUpdate;
use App\Models\User;
use App\Models\Incident;

use Faker\Generator as Faker;

$factory->define(IncidentUpdate::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'incident_id' => factory(Incident::class),
        'name' => $faker->name,
        'status' => $faker->randomElement(
            array_keys(config('laravel-status-page.incident-statuses'))
        ),
        'message' => $faker->sentences(2, true)
    ];
});
