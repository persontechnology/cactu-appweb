<?php

namespace App\Policies;

use App\Models\Carta;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CartaPolicy
{
    
    public function ver(User $user, Carta $carta): bool
    {
        if($carta->estado==='Respondida'){
            if($user->hasRole('ADMINISTRADOR')){
                return true;
            }else{
                if($user->id==$carta->user_id){
                    return true;
                }else{
                    return false;
                }
            }
        }
        return false;
    }
    public function eliminar(User $user, Carta $carta): bool
    {
        if($carta->estado==='Enviado'){
            if($user->hasRole('ADMINISTRADOR')){
                return true;
            }else{
                if($user->id==$carta->user_id){
                    return true;
                }else{
                    return false;
                }
            }
        }
        return false;
    }


    // responder la carta por parte del niño
    public function responderCartaXninio(?User $user, Carta $carta): bool
    {
        if($carta->estado==='Respondida'){
            return false;
        }
        return true;
    }


    
}
