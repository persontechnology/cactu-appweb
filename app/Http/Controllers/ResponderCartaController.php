<?php

namespace App\Http\Controllers;

use App\Models\Carta;
use App\Models\Ninio;
use App\Notifications\EnviarCartaRespondidaGestor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ResponderCartaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($ninio_numero_child)
    {
        
        try {
            $ninio_decrypt = Crypt::decryptString($ninio_numero_child);
            $ninio=Ninio::where('numero_child',$ninio_decrypt)->firstOrFail();
            $data = array(
                'ninio'=>$ninio,
                'cartas'=>$ninio->cartas->where('estado','Enviado')
            );
            return view('responder-cartas.index',$data);    
        } catch (DecryptException $e) {
         return abort(404);
        }
    }

    public function ver($idcarta,$ninio_numero_child) {
       
        try {
            $idcarta_decrypt = Crypt::decryptString($idcarta);
            $ninio_numero_child_decrypt = Crypt::decryptString($ninio_numero_child);
            $carta=Carta::findOrFail($idcarta_decrypt);
            if($carta->ninio->numero_child===$ninio_numero_child_decrypt){
                return view('responder-cartas.todas-cartas',['carta'=>$carta,'ninio'=>$carta->ninio]);
            }else{
                return abort(404);
            }
            
        } catch (DecryptException $e) {
            return abort(404);
        }
    }

    public function verArchivo($idCarta,$tipo)
    {
        try {
            $carta=Carta::findOrFail(Crypt::decryptString($idCarta));
            switch ($tipo) {
                case 'foto':
                    return Storage::get($carta->archivo_imagen);        
                    break;
                case 'pdf':
                    return Storage::response($carta->archivo_pdf);        
                    break;
                default:
                    return '';
                    break;
            }
        } catch (DecryptException $th) {
            return abort(404);
        }
    }

    public function guardarContestacion(Request $request) {
        $request->validate([
            'id'=>'required',
            'imagen'=>'required',
            'detalle'=>'required'
        ]);
        $detalle= '<p> '. $request->nombre_patrocinador.
                    ''.$request->agradezco_por.'</p>'.
                    '<p> '.$request->te_cuento_que.'</p>'.
                    '<p>¿ '.$request->pregunta_al_patrocinador.' ?</p>'.
                    '<p>'.$request->detalle.'</p>';
        $request['detalle']=$detalle;
        return $this->guardarArchivo($request);
    }

    public function guardarAgradecimiento(Request $request) {
        $request->validate([
            'id'=>'required',
            'imagen'=>'required',
            'detalle'=>'required'
        ]);
        $detalle= '<p>'. $request->nombre_patrocinador.
                    ''.$request->agradezco_por.'</p>'.
                    '<p> '.$request->regalo_usar_para.'</p>'.
                    '<p> '.$request->te_cuento_que.'</p>'.
                    '<p>¿ '.$request->pregunta_al_patrocinador.' ?</p>'.
                    '<p>'.$request->detalle.'</p>';

        $request['detalle']=$detalle;
        return $this->guardarArchivo($request);
    }
   public function guardarIniciada(Request $request)  {
        $request->validate([
            'id'=>'required',
            'imagen'=>'required',
            'detalle'=>'required'
        ]);
        $detalle= '<p>'. $request->nombre_patrocinador.'</p>'.
                    '<p>'.$request->te_cuento_que.'</p>'.
                    '<p>'.$request->en_cactu_aprendi.'</p>'.
                    '<p>¿ '.$request->pregunta_al_patrocinador.' ?</p>'.
                    '<p>'.$request->detalle.'</p>';

        $request['detalle']=$detalle;
        return $this->guardarArchivo($request);
   }
    public function guardarArchivo(Request $request)
    {
        try {
            DB::beginTransaction();
            $carta=Carta::findOrFail(Crypt::decryptString($request->id));
            
            $this->authorize('responderCartaXninio',$carta);
            
            $url_foto_ninio=$this->guardarImagenBase64($carta->id.'.png',$request->input('imagen'),'foto_personal');

            if($request->foto_familia){
                $carta->archivo_familia_ninio=$this->guardarImagenBase64($carta->id.'.png',$request->input('foto_familia'),'foto_familia');
            }

            $carta->archivo_imagen_ninio=$url_foto_ninio;
            $carta->detalle=$request->detalle;
            $carta->estado='Respondida';
            $carta->fecha_respondida=Carbon::now();
            $carta->save();
            $carta->gestor->notify(new EnviarCartaRespondidaGestor($carta));
            DB::commit();
            Session::flash('success','La respuesta a su carta ha sido enviada satisfactoriamente.');
            return redirect()->route('cartas-ninio.index',Crypt::encryptString($carta->ninio->numero_child));
        } catch (DecryptException $e) {
            DB::rollBack();
            return abort(404);
        }
    }

    public function guardarImagenBase64($nombreImagen,$imagenBase64,$tipo) {
        $tempFolderPath='temp';
        if (!Storage::exists($tempFolderPath)) {
            Storage::makeDirectory($tempFolderPath);
        }
        $tempDirectoryPath = Storage::path($tempFolderPath);
        list(, $imagenCodificada) = explode(';', $imagenBase64);
        list(, $imagenCodificada) = explode(',', $imagenCodificada);
        $imagenDecodificada = base64_decode($imagenCodificada);
        // Guardar la imagen decodificada en una ubicación temporal
        $rutaTempImagen = $tempDirectoryPath . '/' . $nombreImagen;
        file_put_contents($rutaTempImagen, $imagenDecodificada);
        
        // Mover la imagen al almacenamiento de Laravel
        
        if($tipo==='foto_personal'){
            $rutaImagen = Storage::putFileAs('public/cartas/archivo_imagen_ninio', new File($rutaTempImagen), $nombreImagen);
        }else{
            $rutaImagen = Storage::putFileAs('public/cartas/archivo_familia_ninio', new File($rutaTempImagen), $nombreImagen);
        }
        
        
        // Eliminar la imagen temporal
        unlink($rutaTempImagen);
        
        return $rutaImagen;
    }


    public function guardarPresentacionMayor(Request $request) {

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
        
       $detalle= '<p>'. $request->hola.
        '</p><p> '.$request->soy.
        '  '.$request->meDicen.
        '</p><p>  '.$request->edad.
        '</p><p>  '.$request->miMejorAmigo.
        ' '.$request->esMejorAmigo.
        '</p><p>  '.$request->loquehago.
        '</p><p> '.$request->miSueno.
        '</p><p> '.$request->dondeAprendo.
        '  '.$request->gustaAprendes.
        '</p><p>  '.$request->mePaso.
        '</p><p>  '.$request->meGustaria.
        '</p><p>  '.$request->miFamilia.
        '</p><p>'.
        '</p><p>  '.$request->nuestraPro.
        '  '.$request->idioma.
        '</p><p>'.
        ' '.$request->lugarFavorito.
        '</p><p>'.
        '</p><p> '.$request->comidaTipica.
        '  '.$request->comer.
        '</p><p>  '.$request->masMeGusta.
        '</p><p></p><p>¿ '.$request->pregunta.
        '?</p><p>'.$request->despedida.
        '</p>';

        $request['detalle']=$detalle;
        return $this->guardarArchivo($request);
        

    }

    public function guardarPresentacionMenor(Request $request) {

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
        '<p> '.$request->hola.'</p>'.
        '<p> '.$request->escribo.''.
        ' '.$request->mi.' '.
        ''.$request->queel.'</p>'.
        '<p> '.$request->cumple.' '.
        ' '.$request->noSabe.'</p>'.
        '<p> '.$request->ademas.' '.
        ''.$request->leGusta.'</p>'.
        '<p> '.$request->dondeAprendo.'</p>'.
        '<p> '.$request->gustaAprendes.' '.
        ' '.$request->mePaso.'</p>'.
        '<p>'.$request->meGustaria.'</p>'.
        '<p> '.$request->miNombre.' '.
        ''.$request->ysoy.' '.
        ''.$request->de.'</p>'.
        '<p> '.$request->mifamila.'</p>'.
        '<p> '.$request->nuestraPro.' '.
        ''.$request->idioma.'</p>'.
        '<p> '.$request->lugarFavorito.'</p>'.
        '<p> '.$request->comidaTipica.' '.
        ' '.$request->ya.' '.
        ''.$request->comer.'</p>'.
        '<p> '.$request->masMeGusta.'</p>'.
        '<p><b>¿ '.$request->pregunta.'?</b></p>'.
        '<p> '.$request->despedida.'</p>';
        
        $request['detalle']=$detalle;
        return $this->guardarArchivo($request);
    }
    

}
