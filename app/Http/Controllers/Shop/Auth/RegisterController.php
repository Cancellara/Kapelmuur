<?php

namespace App\Http\Controllers\Shop\Auth;

use App\Model\Shop\Shop;
use App\Model\Shop\ShopType;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new shop as well as their
    | validation and creation.
    |
    */

    use RegistersUsers;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/shop/typeSelection';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:shop');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'cif' => ['required', 'max:9', 'unique:shops'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:shops'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'accept_conditions' => ['required'],
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Model\Shop\Shop
     */
    protected function create(array $data)
    {
        $shopType = ShopType::where("description","=",'Free')->select("id") -> first() -> id;

        return Shop::create([
            'name' => $data['name'],
            'cif'   => $data['cif'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'active' => false,
            'activation_code' => $data['activation_code'],
            'shop_type' => $shopType, //Siempre la creamos como free pero inactiva.
        ]);
    }
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $request['activation_code'] = str_random(30).time();

        event(new Registered($shop = $this->create($request->all())));

        return $this->registered($request, $shop)
            ?: redirect($this->redirectPath());
    }
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('shop');
    }
    /**
     * Muestra el formulario para elegir tipo de tienda.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showTypeSelectionForm()
    {
        $shopTypes = ShopType::all();

        return view('shop/typeSelection')->with(['shopTypes' => $shopTypes]);

    }
}
