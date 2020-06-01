<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Blogs;
use Faker\Generator as Faker;

$factory->define(Blogs::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(6, true),
        'slag' => $faker->sentence(6, true),
        'category' => factory(\App\Model\Categories::class),
        'author' => factory(\App\User::class),
        'description' => $faker->paragraph(10, true),
        'image' => 'https://via.placeholder.com/150',
        'status' => 'inactive'
    ];
});
