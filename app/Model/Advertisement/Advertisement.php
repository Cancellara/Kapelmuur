<?php

namespace App\Model\Advertisement;

use App\Model\Shop\Shop;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'category', 'shop'
    ];

    /**
     * Relación de eloquent.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relación de Eloquent
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Relación de Eloquent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
