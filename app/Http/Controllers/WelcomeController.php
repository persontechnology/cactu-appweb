<?php

namespace App\Http\Controllers;

use App\Models\Carta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WelcomeController extends Controller
{
    public function pdfninio($id) {
        $carta=Carta::findOrFail($id);
        return Storage::response($carta->archivo_pdf);  
    }
}
