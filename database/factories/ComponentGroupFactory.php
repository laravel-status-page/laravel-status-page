<?php

/** @var Factory $factory */

use App\Models\ComponentGroup;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(
    ComponentGroup::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'visible' => $faker->boolean
    ];
});
