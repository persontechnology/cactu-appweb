<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Boleta extends Model
{
    use HasFactory;

    public function getArchivoImagenLinkAttribute()
    {
        if(Storage::exists($this->archivo_imagen)){
            return Storage::url($this->archivo_imagen) ;
        }
    }
}
