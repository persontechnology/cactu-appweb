<?php

namespace App\Http\Controllers;

use App\Http\Clases\ValidadorEc;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function validarec(Request $request)
    {
        $validatorEC = new ValidadorEc();
        $res= $validatorEC->validarIdentificacion($request->identificacion);
        return json_encode($res);
    }
}
