<?php

namespace App\Model\Advertisement;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'category',
    ];

    /**
     * Relación de Eloquent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relación de Eloquent.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class);
    }

    /**
     * Relación de Eloquent.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articleValues()
    {
        return $this->hasMany(ArticleValue::class);
    }

}
