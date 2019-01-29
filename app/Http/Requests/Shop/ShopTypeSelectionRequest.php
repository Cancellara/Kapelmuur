<?php

namespace App\Http\Requests\Shop;

use App\Model\Shop\Shop;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShopTypeSelectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if((auth('shop')->check()) && (auth('shop')->user()->active == 0))
            return true;
        else
            return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'shopType' => ['required' , Rule::in(Shop::getShopTypeIdList())],

        ];
    }
}
