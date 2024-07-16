@extends('layouts.app')

@section('breadcrumbs')
{{ Breadcrumbs::render('cartas.documentos',$carta) }}
@endsection

@section('content')
  <div class="row">
    @if ($carta->boletas->count()>0)

    @php
        $i=1;
    @endphp
    @foreach ($carta->boletas as $boleta)
    
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>BOLETA {{ $i++ }}</strong>
                </div>
                <div class="card-img-actions" >
                    <img class="card-img-top img-fluid" src="{{ route('verBoletaArchivoImagen',$boleta->id) }}" alt="">
                </div>
            </div>
        </div>

    @endforeach
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
