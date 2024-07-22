<?php

namespace App\Http\Controllers;

use App\Models\Carta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use PDF;
class WelcomeController extends Controller
{
    public function pdfninio($id) {
        try {
            $carta=Carta::findOrFail(Crypt::decryptString($id));
            return Storage::response($carta->archivo_pdf);
        } catch (DecryptException $e) {
            return response()->json(['error'=>'Carta resgitrado exitosamente']);
        }
    }

    public function descargarCartaPdf($id) {
        $carta=Carta::findOrFail($id);
        $title='CARTA DE '.$carta->ninio->nombres_completos.'.pdf';
        $data = array(
            'carta'=>$carta,
            'title'=>$title
        );
        
        $pdf = PDF::loadView('cartas.verpdf', $data) ->setOption('margin-top', 5) ->setOption('margin-bottom', 1);
        return $pdf->download($title );
    }

    public function privacidad()  {
        return view('privacidad');
    }
  
}
