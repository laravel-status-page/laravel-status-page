<?php

/** @var Factory $factory */

use App\Model;
use App\Models\Component;
use App\Models\ComponentGroup;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(
    Component::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'status' => $faker->randomElement(
            array_keys(config('laravel-status-page.statuses'))
        ),
        'component_group_id' => factory(ComponentGroup::class)
    ];
});
