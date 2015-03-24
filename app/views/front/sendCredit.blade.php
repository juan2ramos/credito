@extends('layout/front')
@section('title') login @stop
@section('content')
@include('layout.notify')
    @if($messages)
        <script>
            var notify = document.getElementById('notify');
            notify.classList.add('is-show');
            notify.classList.add('success');
            notify.querySelector('.text-notify').innerText = 'Se ha actualizado los permisos correctamente';
        </script>
    @endif
        <p style="text-align:center">ya estamos verificando los datos de tu solicitud de credito. Puedes ver nuestro productos <a href="http://lilipink.com/" target="_blank">aqui</a></p>

    @include('layout.load')
@stop
