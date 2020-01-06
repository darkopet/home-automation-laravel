<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DeviceType;
use Faker\Generator as Faker;

$factory->define(DeviceType::class, function (Faker $faker) {
    return [
        'name' => 'Switch'
    ];
});
