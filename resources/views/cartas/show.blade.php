@extends('layouts.app')

@section('breadcrumbs')
{{ Breadcrumbs::render('cartas.show',$carta) }}
@endsection



@section('content')
<div class="card">
  <a href="{{ asset(Storage::url($carta->archivo_pdf)) }}">{{ asset(Storage::url($carta->archivo_pdf)) }}</a>
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
