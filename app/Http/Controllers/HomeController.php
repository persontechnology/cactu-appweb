<?php

namespace App\Http\Controllers;

use App\Http\Clases\ValidadorEc;
use Illuminate\Http\Request;
use Kutia\Larafirebase\Facades\Larafirebase;

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
        // $deviceTokens ="fIZ32RiFQiGStpStPvjVzv:APA91bFfy8gl2CCtE3uGEqRDiZ9TO7DgLnhNF9S1-yBes6bOWqSod89XCD1__fLbwO7IzUv--JgNZVZq3vGkcWvaqVayYnT6YYm2tSWYTdmI6ZY47dhENUhUBSftp3XtiZJzJVMQNntz";
        // return Larafirebase::withTitle('Nueva carta')->withBody('Tiene una nueva carta de PRESENTACIÓN por responder.')->sendNotification($deviceTokens);


        return view('home');
    }

    public function validarec(Request $request)
    {
        $validatorEC = new ValidadorEc();
        $res= $validatorEC->validarIdentificacion($request->identificacion);
        return json_encode($res);
    }
}
