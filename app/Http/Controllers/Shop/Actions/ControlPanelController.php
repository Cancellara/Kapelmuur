<?php

namespace App\Http\Controllers\Shop\Actions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ControlPanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:shop');

    }
    /**
     * Muestra panel de control de un usuario registrado.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showControlPanel()
    {
        return view('shop.controlPanel');
    }
}
