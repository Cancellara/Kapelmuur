<?php
/**
 * Created by PhpStorm.
 * User: Cuchufleto
 * Date: 10/02/2019
 * Time: 11:34
 */

namespace App\Model\View\Advertisement;


use App\Model\Advertisement\Advertisement;
use App\Model\Advertisement\Article;
use App\Model\Advertisement\Category;
use App\Model\Shop\Shop;

class AdvertisementView
{
    private $shop;
    private $category;
    private $description;
    private $articles = array();

    /**
     * AdvertisementView constructor.
     *
     */
    function __construct(int $id)
    {
        $advertisement = Advertisement::find($id);
        $this->setShop(Shop::find($advertisement->shop)->name);
        $this->setCategory(Category::find($advertisement->category)->title);
        $this->setDescription($advertisement->description);
        $this->setArticles($id);
    }

    /**
     * @return array
     */
    public function getArticles(): array
    {
        return $this->articles;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @param mixed $shop
     */
    public function setShop($shop): void
    {
        $this->shop = $shop;
    }

    /**
     * @param array $articles
     */
    public function setArticles(int $id): void
    {
        $articlesAux = Article::where('advertisement', '=', $id)->get();

        //dd($articlesAux);
        foreach ($articlesAux as $index)
        {
            array_push($this->articles, new ArticleView($index->id));
        }

        //dd($this->articles);
    }

}