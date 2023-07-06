<?php

namespace App\Policies;

use App\Models\Ninio;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NinioPolicy
{
    

    // si el niño pertenece al gestor usuario puede editar o si es admin el usuario
    public function update(User $user, Ninio $ninio): bool
    {
        if($user->hasRole('ADMINISTRADOR')){
            return true;
        }else{
            if($ninio->comunidad->user_id==$user->id){
                return true;
            }else{
                return false;
            }
        }
    }

   
    public function delete(User $user, Ninio $ninio): bool
    {
        if($user->hasRole('ADMINISTRADOR')){
            return true;
        }else{
            if($ninio->comunidad->user_id==$user->id){
                return true;
            }else{
                return false;
            }
        }
    }

   
}
