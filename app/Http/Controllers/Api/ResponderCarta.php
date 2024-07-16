<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Carta;
use App\Models\Ninio;
use App\Notifications\EnviarCartaRespondidaGestor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class ResponderCarta extends Controller
{

    public function listaCartas (Request $request) {
        $ninio = Ninio::find($request->userId);
        

        $cartas = $ninio->cartas()
            ->where('eliminado',false)
            ->orderByRaw("CASE WHEN estado = 'Enviado' THEN 0 ELSE 1 END")
            ->orderBy('created_at', 'desc')
            ->get();

        $data = array();
        foreach ($cartas as $carta) {

            array_push($data, [
                'created_at' => $carta->created_at->format('d/m/Y H:i:s'),
                'id' => $carta->id,
                'asunto' => $carta->asunto,
                'tipo_carta_nombre' => $carta->tipo,
                'estado'=>$carta->estado,
                'edad' => Carbon::parse($carta->ninio->fecha_nacimiento)->age??0,
                'archivo'=>$carta->archivo_pdf?route('verarchivopdfporninio',Crypt::encryptString($carta->id)):'no',
                'carta'=>$carta->estado=='Respondida'?route('descargarCartaPdf',$carta->id):'no',
                'carta_nombre'=>$carta->estado=='Respondida'?'Carta-de-'.$carta->tipo.'-'.$carta->id.'.pdf' :'',
                'eliminado'=>$carta->eliminado
            ]);
        }

        return response()->json(['data' => $data]);
    }

    public function responderCartaPresentacionMayor(Request $request) {

        $request->validate([
            'imagen'=>'required',
            'foto_familia'=>'required',
            'id'=>'required',
            'hola'=>'required',
            'soy'=>'required',
            'meDicen'=>'required',
            'edad'=>'required',
            'miMejorAmigo'=>'required',
            'esMejorAmigo'=>'required',
            'loquehago'=>'required',
            'miSueno'=>'required',
            'dondeAprendo'=>'required',
            'gustaAprendes'=>'required',
            'mePaso'=>'required',
            'meGustaria'=>'required',
            'miFamilia'=>'required',
            'nuestraPro'=>'required',
            'idioma'=>'required',
            'lugarFavorito'=>'required',
            'comidaTipica'=>'required',
            'comer'=>'required',
            'masMeGusta'=>'required',
            'pregunta'=>'required',
            'despedida'=>'required'
        ]);
        
       $detalle= '<p> '. $request->hola.
        '</p><p>  '.$request->soy.
        '  '.$request->meDicen.
        '</p><p>  '.$request->edad.
        '</p><p>  '.$request->miMejorAmigo.
        '  '.$request->esMejorAmigo.
        '</p><p> '.$request->loquehago.
        '</p><p> '.$request->miSueno.
        '</p><p> '.$request->dondeAprendo.
        '  '.$request->gustaAprendes.
        '</p><p>  '.$request->mePaso.
        '</p><p>  '.$request->meGustaria.
        '</p><p>  '.$request->miFamilia.
        '</p><p><b>'.
        '</b></p><p>  '.$request->nuestraPro.
        '  '.$request->idioma.
        '</p><p>'.
        '  '.$request->lugarFavorito.
        '</p><p>'.
        '</p><p>  '.$request->comidaTipica.
        '  '.$request->comer.
        '</p><p> '.$request->masMeGusta.
        '</p><p>¿ '.$request->pregunta.
        '?</p><p>'.$request->despedida.
        '</p>';

        $request['detalle']=$detalle;
        return $this->guardarCarta($request);
        

    }

    public function responderCartaPresentacionMenor(Request $request) {

        $request->validate([
            'imagen'=>'required',
            'foto_familia'=>'required',
            'id'=>'required',
            'hola'=>'required',
            'escribo'=>'required',
            'mi'=>'required',
            'queel'=>'required',
            'cumple'=>'required',
            'noSabe'=>'required',
            'ademas'=>'required',
            'leGusta'=>'required',
            'dondeAprendo'=>'required',
            'gustaAprendes'=>'required',
            'mePaso'=>'required',
            'meGustaria'=>'required',
            'miNombre'=>'required',
            'ysoy'=>'required',
            'de'=>'required',
            'mifamila'=>'required',
            'nuestraPro'=>'required',
            'idioma'=>'required',
            'lugarFavorito'=>'required',
            'comidaTipica'=>'required',
            'ya'=>'required',
            'comer'=>'required',
            'masMeGusta'=>'required',
            'pregunta'=>'required',
            'despedida'=>'required',
        ]);
    
        $detalle=
        '<p>'.$request->hola.'</p>'.
        '<p> '.$request->escribo.''.
        '  '.$request->mi.' '.
        ''.$request->queel.'</p>'.
        '<p> '.$request->cumple.' '.
        ' '.$request->noSabe.'</p>'.
        '<p> '.$request->ademas.' '.
        ''.$request->leGusta.'</p>'.
        '<p> '.$request->dondeAprendo.'</p>'.
        '<p> '.$request->gustaAprendes.' '.
        ' '.$request->mePaso.'</p>'.
        '<p> '.$request->meGustaria.'</p>'.
        '<p> '.$request->miNombre.' '.
        ''.$request->ysoy.' '.
        ''.$request->de.'</p>'.
        '<p> '.$request->mifamila.'</p>'.
        '<p> '.$request->nuestraPro.' '.
        ''.$request->idioma.'</p>'.
        '<p>'.$request->lugarFavorito.'</p>'.
        '<p>'.$request->comidaTipica.' '.
        ' '.$request->ya.' '.
        ' '.$request->comer.'</p>'.
        '<p>'.$request->masMeGusta.'</p>'.
        '<p><b>¿ '.$request->pregunta.'?</b></p>'.
        '<p> '.$request->despedida.'</p>';
        
        $request['detalle']=$detalle;
        return $this->guardarCarta($request);
    }

    public function guardarCarta(Request $request){
        $request->validate([
            'id'=>'required',
            'imagen'=>'required',
            'detalle'=>'required'
        ]);
        
        try {
            DB::beginTransaction();
            $carta=Carta::findOrFail($request->id);

            if($carta->estado=='Respondida'){
                return response()->json(['info'=>'Carta ya fue respondida']);
            }else{
                if ($request->hasFile('imagen')) {
                    if ($request->file('imagen')->isValid()) {
                        $extension = $request->imagen->extension();
                        $imageName = $carta->id.'.'.$extension;  
                        $path=Storage::putFileAs('public/cartas/archivo_imagen_ninio',$request->file('imagen'),$imageName);
                        $carta->archivo_imagen_ninio=$path;
                    }
                }
                
                if ($request->hasFile('foto_familia')) {
                    if ($request->file('foto_familia')->isValid()) {
                        $extension_f = $request->foto_familia->extension();
                        $imageName_f = $carta->id.'.'.$extension_f;  
                        $path_f=Storage::putFileAs('public/cartas/archivo_familia_ninio',$request->file('foto_familia'),$imageName_f);
                        $carta->archivo_familia_ninio=$path_f;
                    }
                }
                $carta->detalle=$request->detalle;
                $carta->estado='Respondida';
                $carta->fecha_respondida=Carbon::now();
                $carta->save();
                $carta->gestor->notify(new EnviarCartaRespondidaGestor($carta));
                DB::commit();
                return response()->json(['success'=>'Carta resgitrado exitosamente']);
            }


        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error'=>'Carta no registrado vuelva intentar'.$th->getMessage()]);
        }
    }

    public function responderContestacion(Request $request)
    {
        $request->validate([
            'id'=>'required',
            'imagen'=>'required',
            'detalle'=>'required'
        ]);
        $detalle= '<p>'. $request->nombre_patrocinador.
                    ''.$request->agradezco_por.'</p>'.
                    '<p>'.$request->te_cuento_que.'</p>'.
                    '<p>¿ '.$request->pregunta_al_patrocinador.' ?</p>'.
                    '<p>'.$request->detalle.'</p>';
        $request['detalle']=$detalle;
        return $this->guardarCarta($request);
    }

    public function responderAgradecimineto(Request $request) {
        $request->validate([
            'id'=>'required',
            'imagen'=>'required',
            'detalle'=>'required'
        ]);
        $detalle= '<p>'. $request->nombre_patrocinador.
                    ''.$request->agradezco_por.'</p>'.
                    '<p>'.$request->regalo_usar_para.'</p>'.
                    '<p>'.$request->te_cuento_que.'</p>'.
                    '<p>¿ '.$request->pregunta_al_patrocinador.' ?</p>'.
                    '<p>'.$request->detalle.'</p>';

        $request['detalle']=$detalle;
        return $this->guardarCarta($request);
    }

    public function responderIniciada(Request $request) {
        $request->validate([
            'id'=>'required',
            'imagen'=>'required',
            'detalle'=>'required'
        ]);
        $detalle=   '<p>'. $request->nombre_patrocinador.'</p>'.
                    '<p>'.$request->te_cuento_que.'</p>'.
                    '<p>'.$request->en_cactu_aprendi.'</p>'.
                    '<p>¿ '.$request->pregunta_al_patrocinador.' ?</p>'.
                    '<p>'.$request->detalle.'</p>';

        $request['detalle']=$detalle;
        return $this->guardarCarta($request);
    }
    public function enviarMensaje() {
        return response()->json(['success'=>'Carta registrado exitosamente']);
    }


    public function eliminarCarta(Request $request) {
        $request->validate([
            'id'=>'required'
        ]);

        $carta=Carta::find($request->id);
        $carta->eliminado=true;
        $carta->save();
        return response()->json(['success'=>'Carta eliminado exitosamente.!']);
    }

}
