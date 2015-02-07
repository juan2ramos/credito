<!DOCTYPE HTML>
<html>
<head>
    <title>restaurar contraseña</title>
    <meta charset="utf-8" />
    <style>
        body{
            background: red;
        }
    </style>
</head>
<body>
<h1>Su contraseña</h1>
{{ HTML::link(URL::to($link), 'Restaurar contraseña ') }}
</body>
</html>