<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        {{ $title }}
    </title>
    <style>
        #bordeCuerpo {
            border-left: 1px solid #dd5c92;
            border-right: 1px solid #dd5c92;
            padding: 10px;
        }
        #imagenfooter {
            padding-top: 2px;
            padding-left: 5%;
            -webkit-transform: rotate(-2deg);
            -moz-transform: rotate(-2deg);
            -ms-transform: rotate(-2deg);
            transform: rotate(-2deg);
        } 
        p {

            letter-spacing: 1px;
            font-family: Verdana, Geneva, sans-serif;
            font-size: 22px;
        }

        .card-img {
           
            border-radius: 1px;
            width: 90%;
            height: 350px;

        }

        .esta {
            border-spacing: 10px 5px;
            color: rgb(2, 51, 12);

        }

        .footer {
            background-image: url("{!! public_path('img/cartas/pcontestacion.jpg') !!}");
            background-repeat: no-repeat;
            background-size: 100% 350px;
            width: 100%;
            border­radius: 100%;
            overflow: hidden;
        }
        .footer2 {
            background-repeat: no-repeat;
            background-size: 100% 350px;
            text-align: justify;
            width: 100%;
            border­radius: 100%;
            overflow: hidden;
        }

          .cuerpo {
           
            border­radius: 100%;
            overflow: hidden;
            font-size: 24px;
            line-height: 2em;
            text-transform: none;
            text-indent: 2em;
            font: condensed 120% sans-serif;
        }
        .fecha {
            text-align: right;
            font-size: 25px;
        }
    
    </style>
</head>
<body>
    <div class="container1">
        <div class="primer">
            <img height="300px" id="cabecera" src="{!! public_path('img/cartas/ccontestacion.jpg') !!}" width="100%">
        </div>
        <div id="bordeCuerpo">
            <div class="fecha">
                
                <p class="text-center">
                    <b>Ecuador {{ \Carbon\Carbon::parse($carta->fecha_respondida)->format('d/M/Y') }}</b>
                </p>
                <table style="background-color: #c9f1d0; width: 100%;">
                    <tr>
                        <th>N° child de niño: {{ $carta->ninio->numero_child }}</th>
                        <th>Carta de {{ $carta->tipo }}</th>
                    </tr>
                </table>
                <br>
            </div>
            <div class="cuerpo">
                {!! $carta->detalle !!}
            </div>
        </div>
        <div class="footer">
            <img width="75%;" height="450px;" id="imagenfooter" src="{!! public_path($carta->archivo_imagen_ninio_link) !!}" class="img-fluid rounded-top" alt="">
          
            <table class="egt" style="width: 100%; padding: 25px;background-color: #d5dda9;">
                <tbody class="esta">
                    <tr>
                        <th>
                            Número Niño/a.: {{ $carta->ninio->numero_child }}
                            
                        </th>
                        <th>
                            Tipo Carta.: {{ $carta->tipo }}
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="contenedor2">
            <div class="primer">
                <img height="480px" id="cabecera" src="{!! public_path('img/cartas/cacontestacion.jpg') !!}" width="100%" />
            </div>
            <br>
            <br>
            <div style="">
                <img class="card-img" width="100%" src="{{ public_path($carta->archivo_imagen_link) }}" />
            </div>
        </div>
    </div>

    <div class="footer2">
        <p>
            With this letter, you will notice something is different that we are very excited about. We have introduced the
            use of tablets and cell phones that allow children to express themselves in their letters to you by not just
            writing, but also by taking photos of them and their drawings. We hope you enjoy this new kind of letter as much
            as children are enjoying creating them, and learning about technology in the process. Make sure you write back
            to your sponsor child and keep the conversation going!
        </p>
    </div>
    
</body>
</html>



