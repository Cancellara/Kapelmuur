<?php

namespace App\Model\Advertisement;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'advertisement', 'price', 'stock',
    ];

    /**
     * Relación de Eloquent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }

    public function articleValues()
    {
        return $this->hasMany(ArticleValue::class);
    }

}
