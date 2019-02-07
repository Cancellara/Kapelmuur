<?php

namespace App\Model\Advertisement;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attribute', 'value',
    ];

    /**
     * Relacion de Eloquent.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
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
