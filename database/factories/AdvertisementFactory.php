<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Advertisement\Advertisement::class, function (Faker $faker) {
    return [
        'description' => $faker->text(200),
    ];
});
