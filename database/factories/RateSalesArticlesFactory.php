<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Shop\RateSalesArticles::class, function (Faker $faker) {
    return [
        'max_article_value' => 10,
        'percentage' => 1,
    ];
});
