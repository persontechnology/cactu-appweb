<?php

namespace App\Http\Controllers;

use App\DataTables\Carta\NinioDataTable;
use App\DataTables\CartaDataTable;
use App\Models\Carta;
use App\Models\Ninio;
use App\Notifications\EnviarNotificacionCartaNueva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;
class CartaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CartaDataTable $dataTable)
    {
        
        return $dataTable->render('cartas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(NinioDataTable $dataTable)
    {
        return $dataTable->render('cartas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        set_time_limit(120);
        $request->validate([
            'ninio'=>[
                'required',
                Rule::exists('ninios','id')->where(function (Builder $query) {
                    if(!Auth::user()->hasRole('ADMINISTRADOR')){
                        return $query->whereIn('comunidad_id', Auth::user()->comunidades->pluck('id'));
                    }else{
                        return $query;
                    }
                }),
            ],
            'tipo'=>'required|in:Contestación,Presentación,Agradecimiento',
            'asunto'=>'required|string|max:120',
            'boleta'=>'required|mimes:jpeg,png,jpg|image',
            "carta" => "required_if:tipo,==,Contestación|mimes:pdf",
            
        ]);

        try {
            DB::beginTransaction();
            $ninio=Ninio::findOrFail($request->ninio);
            $carta=new Carta();
            $carta->tipo=$request->tipo;
            $carta->asunto=$request->asunto;
            $carta->ninio_id=$request->ninio;
            $carta->user_id=Auth::user()->id;
            $carta->comunidad_id=$ninio->comunidad_id;
            $carta->save();
            
            if ($request->hasFile('boleta')) {
                $path_boleta = Storage::putFileAs(
                    'public/cartas/archivo_imagen', $request->file('boleta'), $carta->id.'.'.$request->file('boleta')->getClientOriginalExtension()
                );
                $carta->archivo_imagen=$path_boleta;
                $carta->save();
            }

            if ($request->hasFile('carta')) {
                $path_carta = Storage::putFileAs(
                    'public/cartas/archivo_pdf', $request->file('carta'), $carta->id.'.'.$request->file('carta')->getClientOriginalExtension()
                );
                $carta->archivo_pdf=$path_carta;
                $carta->save();
            }
            DB::commit();
           
            $this->enviarNotificacion($carta);
           
            
            Session::flash('success','Carta de '.$carta->tipo.' enviada a '.$ninio->nombres_completos);
            return redirect()->route('cartas.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash('info','Carta no enviado'.$th->getMessage());
            return redirect()->back()->withInput();
        }

    }

    public function enviarNotificacion($carta){

        if($carta->ninio->email || $carta->ninio->fcm_token){
            $carta->ninio->notify(new EnviarNotificacionCartaNueva($carta));
        }
        
    }
    /**
     * Display the specified resource.
     */
    public function show(Carta $carta)
    {
        
        return view('cartas.show',['carta'=>$carta]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carta $carta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carta $carta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carta $carta)
    {
        $this->authorize('eliminar',$carta);
        try {
            if($carta->delete()){
                
                if(Storage::exists($carta->archivo_imagen??'archivo_imagen.pngx')){
                    Storage::delete($carta->archivo_imagen);
                }
                if(Storage::exists($carta->archivo_pdf??'archivo_pdf.pngx')){
                    Storage::delete($carta->archivo_pdf);
                }
            }
            Session::flash('success','Carta eliminado.!');
        } catch (\Throwable $th) {
            Session::flash('info','Carta no eliminado.!'.$th->getMessage());
        }
        return redirect()->route('cartas.index');
    }

    public function verPDF($id) {
        $carta=Carta::findOrFail($id);
        $title='CARTA DE '.$carta->ninio->nombres_completos;
        $data = array(
            'carta'=>$carta,
            'title'=>$title
        );
        
        $pdf = PDF::loadView('cartas.verpdf', $data) ->setOption('margin-top', 5) ->setOption('margin-bottom', 1);
        return $pdf->inline($title );
    }
    
    public function verArchivo($idcarta,$tipo)
    {
        $carta=Carta::findOrFail($idcarta);
        switch ($tipo) {
            case 'archivo_imagen_ninio':
                return Storage::get($carta->archivo_imagen_ninio);        
                break;
            case 'archivo_pdf':
                return Storage::get($carta->archivo_pdf);        
                break;
            case 'archivo_imagen':
                return Storage::get($carta->archivo_imagen);        
                break;
                
            default:
                return '';
                break;
        }
    }

    public function documentos($id) {
        $carta=Carta::findOrFail($id);
        return view('cartas.documentos',['carta'=>$carta]);
    }

}
