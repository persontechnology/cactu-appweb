@extends('responder-cartas.principal')
@section('content')

    @if ($carta->tipo==='Contestación')
        @include('responder-cartas.contestacion',['carta'=>$carta,'ninio'=>$ninio])
    @endif
    

    @if ($carta->tipo==='Agradecimiento')
        @include('responder-cartas.agradecimineto',['carta'=>$carta,'ninio'=>$ninio])
    @endif

    @if ($carta->tipo==='Iniciada')
        @include('responder-cartas.iniciada',['carta'=>$carta,'ninio'=>$ninio])
    @endif

    @if ($carta->tipo==='Presentación')
        @php
            $edad=Carbon\Carbon::parse($ninio->fecha_nacimiento)->age
        @endphp

        @if ($edad>5)    
            @include('responder-cartas.presentacion-mayores',['carta'=>$carta,'ninio'=>$ninio,'edad'=>'para mayores de 5 años'])
        @else
            @include('responder-cartas.presentacion-menores',['carta'=>$carta,'ninio'=>$ninio,'edad'=>'para menores de 5 años'])
        @endif  

    @endif
@endsection