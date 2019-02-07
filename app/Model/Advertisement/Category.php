<?php

namespace App\Model\Advertisement;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
    ];

    /**
     * Relación de Eloquent
     *
     * @return mixed
     *
     */
    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }

}
