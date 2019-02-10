<?php
/**
 * Created by PhpStorm.
 * User: Cuchufleto
 * Date: 10/02/2019
 * Time: 9:56
 */

namespace App\Model\View\Advertisement;


use App\Model\Advertisement\Article;
use App\Model\Advertisement\ArticleValue;
use App\Model\Advertisement\Attribute;
use App\Model\Advertisement\AttributeValue;

class ArticleView
{

    private $price;
    private $stock;
    private $attributes = array();

    /**
     * ArticleView constructor: Construye un artículo con sus atributos y valores tras recibir el id del mismo.
     * @param int $id
     */
    function __construct(int $id)
    {
        //dd(Article::find($id));
        $this->setPrice(Article::find($id)->price);
        $this->setStock(Article::find($id)->stock);
        $this->setAttributes($id);
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @param mixed $stock
     */
    public function setStock($stock): void
    {
        $this->stock = $stock;
    }

    private function setAttributes(int $id)
    {

        $articlesValues = ArticleValue::where('article','=',$id)->get();
        $array = array();

        foreach ($articlesValues as $articlesValue)
        {
            $attribute = Attribute::find($articlesValue->attribute)->title;
            $value = AttributeValue::find($articlesValue->value)->value;

            //array_push($this->attributes, [$attribute => $value]);
            $array [$attribute] = $value;
        }
        //dd($array['Color']);
        $this->attributes = $array;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }


}