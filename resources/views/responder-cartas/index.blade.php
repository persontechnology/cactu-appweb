@extends('responder-cartas.principal')
@section('content')
    

@if ($cartas->count()>0)
<span class="d-block text-muted py-0">Aquí tienes {{ $cartas->count() }} cartas pendientes que esperan respuesta.</span>
<div class="border rounded ">
    <div class="list-group list-group-borderless mx-2">
        @foreach ($cartas as $carta)
        @php
            $url=route('cartas-ninio.ver',['idcarta'=>Crypt::encryptString($carta->id),'numero_child'=>Crypt::encryptString($ninio->numero_child)]);
        @endphp
            <a href="{{ $url }}" class="list-group-item list-group-item-action">
                <div class="my-1 ">
                    <div class="d-flex justify-content-between mb-1 ">
                        <h6 class="mb-0">
                            <i class="ph ph-caret-right"></i>
                            {{ $carta->tipo }}
                        </h6>
                        <span class="fs-sm text-muted">{{ $carta->created_at->diffForHumans() }}</span>
                    </div>
                    {{ $carta->asunto }}
                </div>
            </a>
        @endforeach
    </div>
</div>
@else
<span class="fw-semibold">No tiene cartas pendientes por responder!</span>
@endif
 
@endsection