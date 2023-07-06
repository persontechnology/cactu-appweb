<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Carta extends Model
{
    use HasFactory;

    protected $fillable=[
        'tipo',
        'asunto',
        'detalle',
        'archivo_imagen',
        'archivo_pdf',
        'archivo_imagen_ninio',
        'ninio_id',
        'user_id',
        'comunidad_id',
        'estado', //Enviado, Respondida
    ];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
             $model->user_id=Auth::id();
        });
        self::updating(function($model){
            // $model->user_id=Auth::id();
        });
        self::created(function($model){
         });
    }

    public function ninio()
    {
        return $this->belongsTo(Ninio::class, 'ninio_id');
    }

    public function gestor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function comunidad(){
        return $this->belongsTo(Comunidad::class,'comunidad_id');
    }

    
    public function getArchivoImagenNinioLinkAttribute()
    {
        if(Storage::exists($this->archivo_imagen_ninio)){
            return Storage::url($this->archivo_imagen_ninio) ;
        }
    }

    public function getArchivoImagenLinkAttribute()
    {
        if(Storage::exists($this->archivo_imagen)){
            return Storage::url($this->archivo_imagen) ;
        }
    }
    
    public function getArchivoFamiliaNinioLinkAttribute()
    {
        if(Storage::exists($this->archivo_familia_ninio)){
            return Storage::url($this->archivo_familia_ninio) ;
        }
    }
    

}
