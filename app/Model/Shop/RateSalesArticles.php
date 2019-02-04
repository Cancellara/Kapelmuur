<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;

class RateSalesArticles extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'max_article_value', 'percentage', 'shop_type'
    ];

    /**
     * Relacion de Eloquent
     *
     */
    public function shopType()
    {
        return $this->belongsTo(ShopType::class);
    }
}
