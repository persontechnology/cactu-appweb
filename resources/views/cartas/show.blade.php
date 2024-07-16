@extends('layouts.app')

@section('breadcrumbs')
{{ Breadcrumbs::render('cartas.show',$carta) }}
@endsection

@section('breadcrumb_elements')
<div class="d-lg-flex mb-2 mb-lg-0">
    <a href="{{ route('cartas.edit',$carta) }}" class="d-flex align-items-center text-body py-2">
        <i class="ph ph-pen"></i>Editar
    </a>
</div>
@endsection

@section('content')
<div class="card">
  <div class="card-header">
    Carta de {{ $carta->tipo }}, del Niñ@: {{ $carta->ninio->nombres_completos }}
  </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="ratio ratio-16x9">
                @can('ver', $carta)
                    <iframe src="{{ route('cartas.ver-carta-pdf',$carta->id) }}" title="YouTube video" allowfullscreen></iframe>
                @else
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  <strong>{{ $carta->ninio->nombres_completos }} no pertenece a usd, o no responde la carta de {{ $carta->tipo }}.</strong> 
                </div>
                @endcan
                
              </div>
        </div>
    </div>
</div>

@endsection
