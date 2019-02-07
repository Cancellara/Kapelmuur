<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Advertisement\Category::class, function (Faker $faker) {
    return [
        'title' => $faker->text(20),
    ];
});
