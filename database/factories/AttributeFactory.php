<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Advertisement\Attribute::class, function (Faker $faker) {
    return [
        'title' => $faker->text(20),
    ];
});
