<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <style>
    table, th, td {
        border: 0px solid white;
        border-collapse: collapse;
        color: rgb(33, 99, 232);
    }
    </style>
</head>
<body>

    <div style="padding-bottom: 20px;">
        <table style="width:100%">
            <tr>
            <th style="text-align: left; width: 50%;">
                  <img src="{{ public_path('img/logo.png') }}" alt="" width="350px">
            </th>
            <th style="width: 50%;" >
                <h2>{{ $title??config('app.name','') }}
                </h2>
            </th>
            </tr>
          </table>
    </div>

</body>
</html>
