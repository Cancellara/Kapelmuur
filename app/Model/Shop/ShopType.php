<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;

class ShopType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'initial_fee', 'monthly_fee', 'max_active_articles',
    ];

    /**
     * Relacion de Eloquent
     *
     */
    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

    /**
     * Relacion de Eloquent
     *
     */
    public function rate_sales_articles()
    {
        return $this->hasMany(RateSalesArticles::class);
    }

}
