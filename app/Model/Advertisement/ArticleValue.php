<?php

namespace App\Model\Advertisement;

use Illuminate\Database\Eloquent\Model;

class ArticleValue extends Model
{
    protected $fillable = [
        'article', 'attribute', 'value',
    ];

    /**
     * Relación de Eloquent.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attributeValue()
    {
        return $this->belongsTo(AttributeValue::class);
    }

    /**
     * Relación de Eloquent.
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
