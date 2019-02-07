<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Advertisement\Article::class, function (Faker $faker) {
    return [
        'price' => 10,
        'stock' => 1000,
    ];
});
