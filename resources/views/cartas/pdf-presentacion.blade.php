<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ $title }}</title>
    <style>
        .esta {
            align-content: center;
        }
        .imgboeltas {
            padding-left: 7em;
        }
        
        .medidaIma1 {
            width: auto;
            padding-right: 4em !important;
        }
        .card-img {
            width: 40%;
            height: 145px;
            padding-left: 1em;
            float: left;
        }
        .medidaIma2 {
            width: auto;
            height: 265px;
            
            padding-right: 3em !important;
        }
        .card-img2 {
            width: 80%;
            height: 265px;
            padding-left: 1em;
            float: left;
        }
        .imagenfoto1 {
            width: 30%;
            height: 185px;
        }
        .imagencuerpo1 {
            height: 295px;
            font-size: 17px;
            padding-left: 6em;
            letter-spacing: 1px;
        }
        .imagenfoto {
            height: 355px;
            width: 100%;
        }
        .rotateimg180 {
            -webkit-transform:rotate(1deg);
            -moz-transform: rotate(1deg);
            -ms-transform: rotate(1deg);
            -o-transform: rotate(1deg);
            transform: rotate(1deg);
        }
        .contenedor {
            background-image: url("{!! public_path('img/cartas/fondo.jpg') !!}");
            background-repeat: no-repeat;
            background-size: 100% 1350px;
            width: 100%;
            height: 1290px;
            border­radius: 100%;
            
            font-family: 'Handlee', cursive;
        }
        .fecha {
            padding-left: 15em;
            padding-top: 2em;
            font-size: 19px;
        }
        .cuerpo {
            padding-top: 0%;
            font-size: 17px;
            padding-left: 8em;
            padding-right: 8em;
            letter-spacing: 1px;
        }
        .cuerpo2 {
            padding-top: 0%;
            font-size: 18px;
            padding-left: 8em;
            padding-right: 8em;
            letter-spacing: 1px;
            height: 120px;
        }
        .cuerpo3 {
            font-size: 18px;
            padding-left: 6em;
            letter-spacing: 1px;
            padding-right: 6em;
            height: 40px;
        }
        .cuerpo4 {
            font-size: 18px;
            padding-left: 6em;
            letter-spacing: 1px;
            padding-right: 6em;
        }
        .cuerpo5 {
            font-size: 19px;
            letter-spacing: 1px;
            padding-right: 6em;
        }
        .cuerpo6 {
            font-size: 19px;
            letter-spacing: 1px;

        }
        .imagencuerpo {
            padding-left: 6em;
            padding-right: 6em;
        }
        .bottom-arrow {
            border-bottom: 15px solid #cbd818;
        }
        .bottom-arrow:after {
            content:'';
            position: absolute;
            left: 0;
            right: 0;
            margin: 0 auto;
            width: 0;
            height: 0;
            border-top: 30px solid #cbd818;
            border-left: 50px solid transparent;
            border-right: 50px solid transparent;
        }
    
    </style>

    
   

</head>
<body>
   <div class="contenedor">
    
        <div class="fecha" style="padding-top: 10em;">
            <h3>Fecha {{ \Carbon\Carbon::parse($carta->fecha_respuesta)->format('d/M/Y')  }} </h3>

        </div>
    <div class="cuerpo">
        <table style="background-color: #cbd818; width: 100%;">
            <tr>
                <th>N° child de niño: {{ $carta->ninio->numero_child }}</th>
                <th>Carta de {{ $carta->tipo }}</th>
            </tr>
        </table>
        <br>
        {!! $carta->detalle !!}
        
    </div> 
   <div class="cuerpo">
    <table style="width: 100%;">
        <tr>
            <th>
                ESTE SOY YO
            </th>
            @if ($carta->archivo_familia_ninio)
                <th>
                    ESTA ES MI FAMILIA
                </th>    
            @endif
            
        </tr>
        <tr>
            <td style=" background: url({!! public_path($carta->archivo_imagen_ninio_link) !!});
                background-repeat: no-repeat;
                background-size: 97% 97%;
                background-position: center; width: 50%; height: 250px; background-color: #0649db;">

            </td>
            @if ($carta->archivo_familia_ninio)
                <td style="background: url({!! public_path($carta->archivo_familia_ninio_link) !!});
                    background-repeat: no-repeat;
                    background-size: 97% 97%;
                    background-position: center; width: 50%; height: 250px; background-color: #034707;">
                </td>
            @endif
        </tr>
    </table>
   </div>
    
   <div class="cuerpo">
    <hr>
        <img style=" width: 100%;" src="{!! public_path($carta->archivo_imagen_link) !!}">
    </div>
    <div>
        @if ($carta->gestor->provincia=='COTOPAXI')
        <img style="width: 100%;" src="{{ public_path('img/cartas/cotopaxi.png') }}">
        @else
        <img style="width: 100%;" src="{{ public_path('img/cartas/tungurahua.png') }}">
        @endif
    </div>
</div>


</body>
</html>