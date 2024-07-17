<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ $title }}</title>
    <style>
        
        body {
            font-family: 'Comic Sans MS', 'Comic Sans', cursive;
            font-size: 1.5em;
        }

        .contenedor {
            background-image: url("{!! public_path('img/cartas/fondo.jpg') !!}");
            background-repeat: no-repeat;
            background-size: 100% 1350px;
            width: 100%;
            height: 1290px;
            border-radius: 100%;
            padding: 20px;
            box-sizing: border-box;
            font-family: 'Handlee', cursive;
        }

        .fecha {
            padding-left: 8em;
            padding-top: 5em;
            font-size: 19px;
        }

        .cuerpo {
            padding-top: 0%;
            font-size: 17px;
            padding-left: 8em;
            padding-right: 8em;
            letter-spacing: 1px;
            border: 3px solid #cbd818; /* Borde alrededor del cuerpo principal */
            margin-bottom: 20px;
        }

        .imagen-del-ninio {
            page-break-inside: avoid; /* Evitar salto de página dentro de la imagen */
            break-inside: avoid; /* Para navegadores modernos */
        }

        .seccion-imagen {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .imagen-ninio,
        .imagen-familia {
            width: 48%;
            height: 500px; /* Ajustar altura según sea necesario */
            background-size: cover;
            background-position: center;
            border: 3px solid #cbd818; /* Borde alrededor de las imágenes de ninio y familia */
            position: relative;
            overflow: hidden; /* Evitar desbordamiento de la imagen */
        }

        .imagen-titulo {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #cbd818;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .boletas {
            padding: 20px;
            background-color: #f0f0f0;
            border: 3px solid #cbd818; /* Borde alrededor de la sección de boletas */
            margin-bottom: 20px;
        }

        .boletas img {
            width: 100%;
          
        }

        .provincia-img {
            width: 100%;
            border: 3px solid #cbd818; /* Borde alrededor de la imagen de provincia */
        }

        .bottom-arrow {
            border-bottom: 15px solid #cbd818;
            position: relative;
            margin-bottom: 20px;
        }

        .bottom-arrow::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: -15px;
            transform: translateX(-50%);
            border-width: 15px 50px 0;
            border-style: solid;
            border-color: #cbd818 transparent transparent;
        }
    </style>
</head>

<body>
    <div class="contenedor">

        <div class="fecha" style="padding-top: 12em; text-align: left;">
            <p style="text-align: left;">Fecha {{ \Carbon\Carbon::parse($carta->fecha_respuesta)->format('d/M/Y') }} </p>
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

        <div class="imagen-del-ninio" style="padding-bottom: 5px;">
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
                    @if ($carta->archivo_imagen_ninio)
                        <td style="
                            background: url({!! public_path($carta->archivo_imagen_ninio_link) !!});
                            background-repeat: no-repeat;
                            background-size: 100% 100%;
                            background-position: center; 
                            width: 50%; 
                            height: 400px;
                            border: 3px solid #cbd818;
                        ">
                            
                        </td>    
                    @endif
                    
                    @if ($carta->archivo_familia_ninio)
                        <td style="
                            background: url({!! public_path($carta->archivo_familia_ninio_link) !!});
                            background-repeat: no-repeat;
                            background-size: 100% 100%;
                            background-position: center; 
                            width: 50%; 
                            height: 400px;
                            border: 3px solid #cbd818;
                        ">
                            
                        </td>
                    @endif
                </tr>
            </table>
        </div>

        <div class="boletas">
            <h4>Boletas</h4>
            
            @if ($carta->archivo_imagen)
                <img width="100%" src="{{ public_path($carta->archivo_imagen_link) }}" />    
            @endif

            @if ($carta->boletas->count() > 0)
                @foreach ($carta->boletas as $boleta)
                    <img width="100%" src="{{ public_path($boleta->archivo_imagen_link) }}" />
                    <br>
                @endforeach
            @endif

        </div>

        <div class="provincia-img">
            @if ($carta->gestor->provincia == 'COTOPAXI')
                <img style="width: 100%;" src="{{ public_path('img/cartas/cotopaxi.png') }}">
            @else
                <img style="width: 100%;" src="{{ public_path('img/cartas/tungurahua.png') }}">
            @endif
        </div>

    </div>

</body>

</html>
