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

        return view('welcome');
    })->name('inicio');

//Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

//USER
//Registro
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'Auth\RegisterController@register')->name('register.user');
    Route::get('/verify/user/{code}', 'Auth\RegisterController@activateUser')->name('activate');
    Route::post('/registerShop', function () {
        return 'register Shop';
    })->name('register.shop');
//Login
    Route::get('login', function () {
        return 'user login';
    })->name('login');


//A ir modificando
// Authentication Routes...
    //$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
    $this->post('login', 'Auth\LoginController@login');
    $this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
});

Route::get('/lang/{lang}', function ($lang) {
    session(['lang' => $lang]);
    return \Redirect::back();
})->where([
    'lang' => 'en|es'
])->name('lang');