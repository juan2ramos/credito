@extends('layout/front')
@section('title') login @stop
@section('content')
    @include('layout.notify')
    @if(Session::has('login_error'))
        <script>
            var notify = document.getElementById('notify');
            notify.classList.add('is-show');
            notify.classList.add('error');
            notify.querySelector('.text-notify').innerText = 'Datos incorrectos';
        </script>
    @endif
    <section class="Login u-shadow-5">
        {{ Form::open(['route' => 'login', 'method' => 'POST', 'role' => 'form', 'class'=>'Login-form','id'=>'loginForm']) }}
        <div class="material-input">
            {{Form::text('email','',['id' => 'email','required'])}}
            {{Form::label('email','E-Mail')}}
            <span></span>
        </div>
        <div class="material-input">
            {{Form::password('password',['id' => 'password','required'])}}
            {{Form::label('password','Password')}}
            <span></span>
        </div>
        <label class="label--checkbox">
            {{Form::checkbox('remember', 1, null, ['class' => 'checkbox'])}}
            Recuerdame
        </label>
        <button class="u-button" id="signUpButton">
            Ingresar
        </button>
        {{ Form::close() }}
        <div class="Remember">
            <a id="Remember" href="{{route('passwordRestart')}}">Olvidaste la contraseña?</a>
        </div>
    </section>
    @include('layout.load')
@stop
@section('javascript')
    {{ HTML::script('js/credit.js'); }}
@stop