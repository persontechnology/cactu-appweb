@extends('layouts.app')

@section('breadcrumbs')
{{ Breadcrumbs::render('cartas.documentos',$carta) }}
@endsection

@section('content')
  <div class="row">
    @if ($carta->archivo_imagen)
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>IMAGEN DE LA BOLETA</strong>
                </div>
                <div class="card-img-actions" >
                    <img class="card-img-top img-fluid" src="{{ route('cartas.ver-archivo',[$carta->id,'archivo_imagen']) }}" alt="">
                </div>
            </div>
        </div>
    @endif
    

    @if ($carta->archivo_pdf)
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>PDF DE LA CARTA</strong>
                </div>
                <div class="card-body">
                    
                    <div class="ratio ratio-16x9">
                        <iframe src="{{ route('cartas.ver-archivo',[$carta->id,'archivo_pdf']) }}" title="YouTube video" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    @if ($carta->archivo_imagen_ninio)
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>IMAGEN PERSONAL DE LA CARTA</strong>
                </div>
                <div class="card-body">
                    <div class="card-img-actions" >
                        <img class="card-img-top img-fluid" src="{{ route('cartas.ver-archivo',[$carta->id,'archivo_imagen_ninio']) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($carta->archivo_familia_ninio)
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>IMAGEN FAMILIAR DE LA CARTA</strong>
                </div>
                <div class="card-body">
                    <div class="card-img-actions" >
                        <img class="card-img-top img-fluid" src="{{ route('cartas.ver-archivo',[$carta->id,'archivo_familia_ninio']) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    @endif
  </div>
@endsection
