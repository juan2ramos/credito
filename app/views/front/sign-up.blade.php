@extends('layout/front')
@section('title') login @stop
@section('content')
    @include('layout.notify')
    <section class="Login u-shadow-5">
        {{ Form::open(['route' => 'login', 'method' => 'POST', 'role' => 'form', 'class'=>'Login-form','id'=>'loginForm']) }}
        @if(Session::has('login_error'))
            <span class="label label-danger">Datos erroneos</span>
        @endif
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