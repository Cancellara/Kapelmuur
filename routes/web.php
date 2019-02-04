<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' =>['multi.language']], function() {

    Route::get('/', function () {

        return view('home');
    })->name('inicio');

//Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

//USER
//Registro
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'Auth\RegisterController@register')->name('register.user');
    Route::get('/verify/user/{code}', 'Auth\RegisterController@activateUser')->name('activate.user');

//Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');

//A ir modificando
// Authentication Routes...
    //$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');

    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...

    //USER
    //Panel de control
    Route::get('/user/controlPanel', 'User\Actions\ControlPanelController@showControlPanel')->name('user.panel');
    //SHOP
//Registro
    Route::post('/registerShop', 'Shop\Auth\RegisterController@register')->name('register.shop');
    Route::get('/shop/typeSelection', 'Shop\Auth\RegisterController@showTypeSelectionForm')->name('shop.typeSelection')->middleware('shop.disabled');
    Route::post('/shop/freeSelection', 'Shop\Auth\RegisterController@typeSelection')->name('shop.selection.free')->middleware('shop.disabled');
    Route::get('/verify/shop/{code}', 'Shop\Auth\RegisterController@activateShop')->name('activate.shop');
    Route::post('/shop/paySelection', 'Shop\Auth\RegistrationPaymentController@initialFeePayment')->name('shop.selection.paying');

    Route::get('status', 'Shop\Auth\RegistrationPaymentController@getPaymentStatus');

    //Inicio sesión
    Route::post('/loginShop', 'Shop\Auth\LoginController@login')->name('login.shop');
    //Panel de control
    Route::get('/shop/controlPanel', 'Shop\Actions\ControlPanelController@showControlPanel')->name('shop.panel');
});



Route::get('/lang/{lang}', function ($lang) {
    session(['lang' => $lang]);
    return \Redirect::back();
})->where([
    'lang' => 'en|es'
])->name('lang');