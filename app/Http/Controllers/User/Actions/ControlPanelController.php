<?php

namespace App\Http\Controllers\User\Actions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ControlPanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');

    }
    /**
     * Muestra panel de control de un usuario registrado.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showControlPanel()
    {
        return view('user.controlPanel');
    }
}
