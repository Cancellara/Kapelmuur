<?php

namespace App\Http\Controllers\Shop\Auth;

use App\Http\Requests\Shop\ShopTypeSelectionRequest;
use App\Mail\ActivationEmail;
use App\Model\Shop\Shop;
use App\Model\Shop\ShopType;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
        $this->middleware('guest:shop')
            ->except(['showTypeSelectionForm', 'typeSelection', 'activateShop']);

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

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());

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
    /**
     * Tipo de tienda elegida.
     * Actualiza el campo shopType al valor seleccionado.
     * Si es una cuenta gratuita envía correo.
     * Si es una cuenta de pago pasa a PayPal.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function typeSelection(ShopTypeSelectionRequest $request)
    {
        $request->validated();

        //Obtenemos la cantidad del pago inicial.
        $amount = ShopType::find($request['shopType'])->initial_fee;
        $name = \auth('shop')->user()->name;
        $email = \auth('shop')->user()->email;
        $activation_code = \auth('shop')->user()->activation_code;
        $layout = 'emails.activation_shop';
        //Si es gratuita: Email
        if($amount <= 0)
        {
            Mail::send(new ActivationEmail($name, $email, $activation_code, $layout));
            return redirect()->route('inicio')->with('result', trans('passwords.sent'));
        }
        else {
            return $amount;
        }
       /* dd($this->guard('shop')->user());
        $shop = $this->guard('shop')->user();*/

    }
    /**
     * Revisa si el código de activación existe y de ser asi activa el usuario en cuestión.
     *
     * @param string $activationCode
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function activateShop(string $activationCode)
    {
        try {
            $shop = app(Shop::class)->where('activation_code', $activationCode)->first();

            if (!$shop) {
                return "ERROR! The code does not exist for any user in our system.";
            }
            $shop->active          = 1;
            $shop->activation_code = null;
            //dd($user);
            $shop->save();
            //auth()->login($user);
        } catch (\Exception $exception) {
            logger()->error($exception);
            return "Whoops! something went wrong.";
        }
        return redirect()->to('/login');
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
}
