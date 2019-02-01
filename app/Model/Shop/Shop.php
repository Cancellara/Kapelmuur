<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Shop extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'cif', 'email', 'password', 'activation_code', 'active', 'shop_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Atributos boleanos para que se haga la conversion de 0 y 1 a bool.
     *
     * @var array
     */
    protected $casts = [
        "active" => "boolean",
    ];

    /**
     * Relacion de Eloquent
     *
     */
    public function shopType()
    {
        return $this->belongsTo(ShopType::class);
    }

    /**
     * Para saber el tipo de usuario autenticado
     *
     *
     * @return boolean
     */
    public function isUser()
    {
        return false;
    }
    /**
     * Devuelve todos los posibles valores de id de los tipos de tienda
     *
     *
     * @return array
     */
    public static function getShopTypeIdList()
    {
        $shopTypes = ShopType::all();

        $shopTypeIdList = array();

        foreach ($shopTypes as $shopType)
        {
            array_push($shopTypeIdList, $shopType->id);
        }

        return $shopTypeIdList;
    }

    /**
     * Para saber el tipo de usuario autenticado
     *
     *
     * @return boolean
     */
    public function isShop()
    {
        return true;
    }

    /**
     * Para saber el tipo de usuario autenticado
     *
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return false;
    }

}
