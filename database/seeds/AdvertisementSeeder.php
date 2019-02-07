<?php

use Illuminate\Database\Seeder;
use \App\Model\Advertisement\Category;
use \App\Model\Advertisement\Attribute;
use \App\Model\Advertisement\AttributeValue;
use \App\Model\Advertisement\Advertisement;
use \App\Model\Shop\Shop;
use \App\Model\Shop\ShopType;
use \App\Model\Advertisement\Article;
use \App\Model\Advertisement\ArticleValue;

class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(AttributeValue::class)->create([
            'attribute' => factory(Attribute::class)->create([
                'category' => factory(Category::class)->Create([
                    'title' => 'Bicicleta'])->id,
                'title' => 'Color',
            ])->id,
            'value' => 'Red',

        ]);

        $categoria = Category::where('title', '=', 'Bicicleta')
            ->first()
            ->id;
        $attribute = Attribute::where('title', '=', 'Color')
            ->first()
            ->id;

        factory(AttributeValue::class)->create([
            'attribute' => $attribute,
            'value' => 'Green'
        ]);

        factory(Attribute::class)->create([
            'category' => $categoria,
            'title' => 'Cassette',
        ]);

        $attribute = Attribute::where('title', '=', 'Cassette')
            ->first()
            ->id;

        factory(AttributeValue::class)->create([
            'attribute' => $attribute,
            'value' => '11-28'
        ]);

        factory(AttributeValue::class)->create([
            'attribute' => $attribute,
            'value' => '11-32'
        ]);


        $shop = ShopType::where('description', '=', 'Premium')->first()->id;

        factory(Advertisement::class)->create([
           'shop' => factory(\App\Model\Shop\Shop::class)->create([
               'name' => 'Tienda1',
               'cif' => '11111111',
               'email' => 'tienda1@tienda1.es',
               'password' => bcrypt('111111'),
               'active' => 1,
               'shop_type' => $shop,
           ]),
            'category' => $categoria,
            'short_description' => 'Trek Domane SL 6 Pro',
            'description' => 'Primer anuncio. Tenemos la Domane disponible en dos colores y con dos desarrollos diferentes',
        ]);

        $anuncio = Advertisement::first()->id;

        factory(Article::class)->create([
            'advertisement' => Advertisement::first()->id,
            'price' => 3000,
            'stock' => 2,
        ]);

        factory(Article::class)->create([
            'advertisement' => Advertisement::first()->id,
            'price' => 2500,
            'stock' => 1,
        ]);

        $article1 = Article::where('price', '=', 3000)->first()->id;
        $article2 = Article::where('price', '=', 2500)->first()->id;
        $color = Attribute::where('title', '=', 'Color')->first()->id;
        $cassete = Attribute::where('title', '=', 'Cassette')->first()->id;

        $colorSelected = AttributeValue::where('value', '=', 'Red')->first()->id;
        $cassetteSelected = AttributeValue::where('attribute', $cassete)->first()->id;

        factory(ArticleValue::class)->create([
            'article'=> $article1,
            'attribute' => $color,
            'value' => $colorSelected,
        ]);

        factory(ArticleValue::class)->create([
            'article'=> $article1,
            'attribute' => $cassete,
            'value' => $cassetteSelected,
        ]);

       $colorSelected = AttributeValue::where('value', '=', 'Green')->first()->id;
        $cassetteSelected = AttributeValue::where('attribute', $cassete)->first()->id;

        factory(ArticleValue::class)->create([
            'article'=> $article2,
            'attribute' => $color,
            'value' => $colorSelected,
        ]);

        factory(ArticleValue::class)->create([
            'article'=> $article2,
            'attribute' => $cassete,
            'value' => $cassetteSelected,
        ]);



        /*factory(Attribute::class)->create([
            'category' => factory(Category::class)->Create([
                'title' => 'Bicicleta'])->id,
            'title' => 'Color',
            ]);



        factory(Category::class)->Create([
            'title' => 'Bicicleta',
        ]);*/
    }
}
