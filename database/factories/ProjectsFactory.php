<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Projects;
use Faker\Generator as Faker;

$factory->define(Projects::class, function (Faker $faker) {
    return [
        'name' => $faker->name()
    ];
});
