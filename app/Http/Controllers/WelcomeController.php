<?php

namespace App\Http\Controllers;

use App\Models\Carta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class WelcomeController extends Controller
{
    public function pdfninio($id) {
        
        try {
            $carta=Carta::findOrFail(Crypt::decryptString($id));
            return Storage::response($carta->archivo_pdf);  
        } catch (DecryptException $e) {
            return 'Documento no encontrado.!';
        }
    }
}
