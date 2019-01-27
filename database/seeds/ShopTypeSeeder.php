<?php

use Illuminate\Database\Seeder;
use App\Model\Shop\ShopType;

class ShopTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ShopType::class)->create([
            'description' => 'Free',
            'initial_fee' => 0.00,
            'monthly_fee' => 0.00,
            'max_active_articles' => 1,
        ]);

        factory(ShopType::class)->create([
            'description' => 'Basic',
            'initial_fee' => 10.00,
            'monthly_fee' => 20.00,
            'max_active_articles' => 10,
        ]);

        factory(ShopType::class)->create([
            'description' => 'Pro',
            'initial_fee' => 20.00,
            'monthly_fee' => 50.00,
            'max_active_articles' => 100,
        ]);

        factory(ShopType::class)->create([
            'description' => 'Premium',
            'initial_fee' => 50.00,
            'monthly_fee' => 100.00,
            'max_active_articles' => 0,
        ]);
    }
}
