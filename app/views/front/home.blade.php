@extends('layout/front')

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

    <div class="Content-home">
        <div id="slider">
            <a href="{{asset('/')}}">
                @for($i=0;$i<count($slidersArrays);$i++)
                    @if($slidersArrays[$i]>0)
                        <img src="sliders/{{$slidersName[$i]}}" />

                    @endif
                @endfor
                @for($i=0;$i<count($slidersArrays);$i++)
                    @if($i==0)
                        <span  class="slider sliderValid">0</span>
                    @else
                        <span  class="slider ">{{$i}}</span>
                    @endif
                @endfor
            </a>
            <span id="back"><</span>
            <span id="next">></span>

        </div>
        <div class="content-sign-up">
            @if(Auth::user())
                <section class="Login">
                    <h2>BIENVENIDO</h2>
                    <section>
                        <p>ahora estan autenticado en creditos.lilipink.com</p>
                    </section>

                    <section>
                        <figure>
                            <a href="">
                                <img src="img/profile-default.png"/>
                            </a>

                        </figure>
                        <div>
                            <p>{{Auth::user()->name}} {{Auth::user()->last_name}}</p>
                            <p>C.C {{Auth::user()->identification_card}}</p>
                            <a href="">actualizar datos</a>
                        </div>
                    </section>
                </section>
            @else
                <section class="Login ">
                    <p>INICIAR SESION</p>
                    {{ Form::open(['url' => 'login', 'method' => 'POST', 'role' => 'form', 'class'=>'Login-form','id'=>'loginForm']) }}

                    <div class="">
                        {{Form::label('email','Correo Electronico.',array('id'=>'email'))}}
                        {{Form::text('email','',['id' => 'emailInput'])}}
                    </div>

                    <div class="">
                        {{Form::label('password','Contraseña.',array('id'=>'password'))}}
                        {{Form::password('password',['id' => 'password'])}}
                    </div>
                    <div>
                        <div class="Remember">
                            <a id="Remember" href="{{route('passwordRestart')}}">Olvidaste la contraseña?</a>
                        </div>
                        <button class="home-button" id="signUpButton-home">
                            IDENTIFICARSE
                        </button>
                    </div>
                    {{ Form::close() }}
                </section>
            @endif
            <div class="content-creditRequest">
                <section class="Home-request ">
                    <p>SOLICITAR CREDITO</p>
                    {{ Form::open(['route' => 'credit', 'method' => 'post', 'role' => 'form', 'class'=>'Login-form','id'=>'loginForm']) }}
                    <div class="">
                        {{Form::label('identification_card','Numero de Cedula..',array('id'=>'email'))}}
                        {{Form::text('identification_card','',['id' => 'identification_card'])}}
                    </div>

                    <div>
                    <div class="Remember">
                        <a id="Remember" href="{{route('passwordRestart')}}">Como funciona?</a>
                    </div>
                        <button class="home-button" id="signUpButton-home">
                            IDENTIFICARSE
                        </button>
                    </div>
                    {{ Form::close() }}

                </section>
            </div>
        </div>

        <div class="content-Request">
            <a href="{{asset('/')}}">
                <img src="{{asset('img/inferior.png')}}">
            </a>
        </div>

    </div>


@stop

@section('javascript')
        {{ HTML::script('js/slider.js'); }}
@stop
