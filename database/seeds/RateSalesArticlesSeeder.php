<?php

use Illuminate\Database\Seeder;

class RateSalesArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shopType = \App\Model\Shop\ShopType::where("description","=",'Free')->first()->id;

        factory(\App\Model\Shop\RateSalesArticles::class)->create([
            'max_article_value' => '10',
            'percentage' => 1,
            'shop_type' => $shopType,
        ]);

        factory(\App\Model\Shop\RateSalesArticles::class)->create([
            'max_article_value' => '20',
            'percentage' => 4,
            'shop_type' => $shopType,
         ]);

        factory(\App\Model\Shop\RateSalesArticles::class)->create([
            'max_article_value' => '50',
            'percentage' => 10,
            'shop_type' => $shopType,
        ]);

        factory(\App\Model\Shop\RateSalesArticles::class)->create([
            'max_article_value' => '100',
            'percentage' => 20,
            'shop_type' => $shopType,
        ]);

        factory(\App\Model\Shop\RateSalesArticles::class)->create([
            'max_article_value' => '999999',
            'percentage' => 40,
            'shop_type' => $shopType,
        ]);

        $shopType = \App\Model\Shop\ShopType::where("description","=",'Basic')->first()->id;

        factory(\App\Model\Shop\RateSalesArticles::class)->create([
            'max_article_value' => '10',
            'percentage' => 1,
            'shop_type' => $shopType,
        ]);

        factory(\App\Model\Shop\RateSalesArticles::class)->create([
            'max_article_value' => '20',
            'percentage' => 3,
            'shop_type' => $shopType,
        ]);

        factory(\App\Model\Shop\RateSalesArticles::class)->create([
            'max_article_value' => '50',
            'percentage' => 18,
            'shop_type' => $shopType,
        ]);

        factory(\App\Model\Shop\RateSalesArticles::class)->create([
            'max_article_value' => '100',
            'percentage' => 18,
            'shop_type' => $shopType,
        ]);

        factory(\App\Model\Shop\RateSalesArticles::class)->create([
            'max_article_value' => '999999',
            'percentage' => 35,
            'shop_type' => $shopType,
        ]);

        $shopType = \App\Model\Shop\ShopType::where("description","=",'Pro')->first()->id;

        factory(\App\Model\Shop\RateSalesArticles::class)->create([
            'max_article_value' => '10',
            'percentage' => 1,
            'shop_type' => $shopType,
        ]);

        factory(\App\Model\Shop\RateSalesArticles::class)->create([
            'max_article_value' => '20',
            'percentage' => 2,
            'shop_type' => $shopType,
        ]);

        factory(\App\Model\Shop\RateSalesArticles::class)->create([
            'max_article_value' => '50',
            'percentage' => 15,
            'shop_type' => $shopType,
        ]);

        factory(\App\Model\Shop\RateSalesArticles::class)->create([
            'max_article_value' => '100',
            'percentage' => 15,
            'shop_type' => $shopType,
        ]);

        factory(\App\Model\Shop\RateSalesArticles::class)->create([
            'max_article_value' => '999999',
            'percentage' => 30,
            'shop_type' => $shopType,
        ]);

        $shopType = \App\Model\Shop\ShopType::where("description","=",'Premium')->first()->id;

        factory(\App\Model\Shop\RateSalesArticles::class)->create([
            'max_article_value' => '10',
            'percentage' => 0,
            'shop_type' => $shopType,
        ]);

        factory(\App\Model\Shop\RateSalesArticles::class)->create([
            'max_article_value' => '20',
            'percentage' => 1,
            'shop_type' => $shopType,
        ]);

        factory(\App\Model\Shop\RateSalesArticles::class)->create([
            'max_article_value' => '50',
            'percentage' => 12,
            'shop_type' => $shopType,
        ]);

        factory(\App\Model\Shop\RateSalesArticles::class)->create([
            'max_article_value' => '100',
            'percentage' => 15,
            'shop_type' => $shopType,
        ]);

        factory(\App\Model\Shop\RateSalesArticles::class)->create([
            'max_article_value' => '999999',
            'percentage' => 25,
            'shop_type' => $shopType,
        ]);
    }
}
