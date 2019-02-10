<?php

namespace Tests\Unit\View\Advertisement;

use App\Model\Advertisement\Advertisement;
use App\Model\Advertisement\Article;
use App\Model\Advertisement\Attribute;
use App\Model\View\Advertisement\AdvertisementView;
use App\Model\View\Advertisement\ArticleView;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdvertisementTest extends TestCase
{
    /** @test     */
    public function it_test_that_an_article_is_created()
    {
        $articleId = Article::all()->first()->id;
        $article = new ArticleView($articleId);
        $articles = $article->getAttributes();
        //dd($article);
        foreach ($articles as $key => $value)
            echo  $key . ' - ' . $value . '\n';

        $this->assertArrayHasKey("Color", $article->getAttributes());
    }

    /** @test */
    public function it_test_that_an_advertisement_is_created()
    {
        $advertisementID = Advertisement::all()->first()->id;
        $advertisement = new AdvertisementView($advertisementID);

        echo $advertisement->getShop();
        echo $advertisement->getCategory();
        dd($advertisement);

        $this->assertTrue(true);

    }


}
