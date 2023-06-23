<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', '') }}</title>
    <style>
        table{
            width: 100%;
        }
        .fondo {
            margin: 0;
            padding: 0;
            color: rgb(33, 99, 232);
            text-align: center;
            line-height:25px;

        }
    </style>
</head>
<body>

    <table class="fondo">
        <thead>
            <tr>
                <td scope="col"><small>{{ config('app.name','') }}</small></td>
                <td scope="col"><small>Salcedo-Ecuador</small></td>
                <td scope="col"><small>Tel. +593 989570091</small></td>
                <td scope="col"><small>www.credimundo.com</small></td>
                <td scope="col"><small>info@credimundo.com.ec</small></td>
            </tr>
        </thead>
    </table>
</body>
</html>