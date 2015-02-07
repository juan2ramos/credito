<!DOCTYPE HTML>
<html>
<head>
    <title>restaurar contraseña</title>
    <meta charset="utf-8" />
</head>
<body>
<h1>Su contraseña</h1>
{{ Form::open(['route' => 'login', 'method' => 'POST', 'role' => 'form', 'class'=>'Login-form','id'=>'loginForm']) }}
<div class="material-input">
    {{Form::password('password',['id' => 'password'])}}
    {{Form::label('password','Password')}}
    <span></span>
</div>
<button class="u-button" id="signUpButton">
    Ingresar
</button>
{{ Form::close() }}
</body>
</html>