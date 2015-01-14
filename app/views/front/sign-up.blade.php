@extends('layout/front')
@section('title') login @stop
@section('content')
<section class="Login u-shadow-5">
    {{ Form::open(['route' => 'login', 'method' => 'POST', 'role' => 'form', 'class'=>'Login-form',]) }}

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
    <button class="u-button">
        Ingresar
    </button>
    {{ Form::close() }}
</section>

@stop