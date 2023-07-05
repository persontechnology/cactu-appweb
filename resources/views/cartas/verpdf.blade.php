@switch($carta->tipo)
    @case('Contestación')
        @include('cartas.pdf-contestacion',['carta'=>$carta])
        @break
    @case('Agradecimiento')
    @include('cartas.pdf-agradecimiento',['carta'=>$carta])
        @break
    @case('Presentación')
        @include('cartas.pdf-presentacion',['carta'=>$carta])
        @break
    @case('Iniciada')
        @include('cartas.pdf-iniciada',['carta'=>$carta])
        @break
    @default
        <h1>NO EXISTE CARTA TIPO {{ $carta->tipo }}</h1>
@endswitch