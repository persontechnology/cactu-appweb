@extends('layouts.app')

@section('breadcrumbs')
{{ Breadcrumbs::render('usuarios.index') }}
@endsection

@section('breadcrumb_elements')
<div class="d-lg-flex mb-2 mb-lg-0">
    <a href="{{ route('cartas.create') }}" class="d-flex align-items-center text-body py-2">
        <i class="ph ph-file-plus"></i>Nuevo
    </a>
</div>
@endsection

@section('content')
<div class="card">
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
                
                <script>
                  var alertList = document.querySelectorAll('.alert');
                  alertList.forEach(function (alert) {
                    new bootstrap.Alert(alert)
                  })
                </script>
                
                @endcan
                
              </div>
        </div>
    </div>
</div>

@endsection
