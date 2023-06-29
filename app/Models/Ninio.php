<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Ninio extends Model
{
    use HasApiTokens,HasFactory,Notifiable;

    protected $fillable=[
        'numero_child',
        'nombres_completos',
        'genero',
        'fecha_nacimiento',
        'edad',
        'comunidad_id',
        'estado',
        'email',
        'numero_celular',
        'fcm_token'
    ];

    public function comunidad()
    {
        return $this->belongsTo(Comunidad::class, 'comunidad_id');
    }
    public function cartas()
    {
        return $this->hasMany(Carta::class, 'ninio_id');
    }
}
