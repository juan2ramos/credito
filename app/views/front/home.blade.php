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

            @foreach($sliders as $key =>$slider)

                @if($key == 0)
                    <a href="http://www.creditoslilipink.com/referidos">
                        <img class="img-slider" src="sliders/{{$slider['files']}}"/>
                    </a>
                @elseif($key == 1)
                    <a href="https://www.youtube.com/watch?v=b2AkFRyohT8" target="_blank">
                        <img class="img-slider" src="sliders/{{$slider['files']}}"/>
                    </a>
                @else
                    <img class="img-slider" src="sliders/{{$slider['files']}}"/>
                @endif


            @endforeach
            @foreach($sliders as $key => $slider)
                @if($key == 0)
                    <span class="slider sliderValid">0</span>
                @else
                    <span class="slider">{{$key}}</span>
                @endif
            @endforeach
            <span id="back"><</span>
            <span id="next">></span>
        </div>
        <div class="content-sign-up">
            @if(Auth::user())
                <section class="Login State">
                    <h2>BIENVENIDA</h2>

                    <section class="content-inf">
                        <figure>
                            <a href="">
                                @if(Auth::user()->photo != "")
                                    {{ HTML::image('users/'.Auth::user()->photo,'',array('id'=>'')) }}
                                @else
                                    {{ HTML::image('users/profile-default.png','',array('id'=>'')) }}
                                @endif
                            </a>

                        </figure>
                        <div>
                            <p class="title">Tu nombre:</p>
                            <p class="title-body">{{Auth::user()->name}} {{Auth::user()->last_name}}</p>
                            <p class="title">Cedula de ciudadania:</p>
                            <p class="title-body">{{Auth::user()->identification_card}}</p>
                            @if(Auth::user()->card != 0)
                                <p class="title">Ya tienes tarjeta</p>
                            @endif
                        </div>
                    </section>
                </section>
            @else
                <section class="Login ">
                    <p>INICIAR SESION</p>
                    {{ Form::open(['route' => 'login', 'method' => 'POST', 'role' => 'form', 'class'=>'Login-form','id'=>'loginForm']) }}

                    <div class="">
                        {{Form::label('email','Email.',array('id'=>'email'))}}
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
            <div class="content-creditRequest"
                 style="background:rgba(13, 12, 12, 0.03) !important; ">
                @if(Auth::user())
                    @if(Auth::user()->roles_id < 4)
                        @if(Auth::user()->roles_id == 1)
                            <p class="type-account">Super administrador<p>
                        @endif
                        @if(Auth::user()->roles_id == 2)
                            <p class="type-account">Administrador</p>
                        @endif
                        @if(Auth::user()->roles_id == 3)
                            <p class="+">Punto de Venta</p>
                        @endif
                    @else
                        <section class="home-request">
                            <h2>PROXIMO PAGO</h2>
                            <div class="content-text state-text">
                                <p>Fecha limite de pago.</p>
                                <p>Pago minimo.</p>
                                <p>Estado.</p>
                            </div>
                            <div class="content-text state-text1">
                                @if(isset($diario))
                                    <p>INMEDIATO</p>
                                    <p>$ {{$diario->pago_minimo}}</p>
                                    <div><p class="state-home">EN MORA.</p></div>
                                @else
                                    <p>/-/-/</p>
                                    <p>$ 0</p>
                                    <div>
                                        @if(Auth::user()->user_state == 1)
                                            <p class="state-home" style="background: #008000 !important;">ACTIVO.</p>
                                        @elseif(Auth::user()->user_state == 2)
                                            <p class="state-home" style="background: indianred !important;">
                                                RECHAZADO</p>
                                        @elseif(Auth::user()->user_state == 0)
                                            <p class="state-home" style="background: #c3c3c3 !important;">
                                                DESACTIVADO</p>
                                        @else
                                            <p class="state-home" style="background: #c3c3c3 !important;">EN ESPERA DE
                                                APROBACIÓN</p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            @if(Auth::user()->user_state == 1 && Auth::user()->hasCredit)
                                <a href="{{route('state')}}">ESTADO DE CUENTA</a>
                            @elseif(Auth::user()->user_state == 2)
                                @if(Auth::user()->roles_id == 4)
                                    <a href="{{url('credito')}}" style="width: 100%">SOLICITAR NUEVAMENTE</a>
                                @elseif(Auth::user()->roles_id == 5)
                                    <a href="{{url('formulario-emprendedoras')}}" style="width: 100%">SOLICITAR
                                        NUEVAMENTE</a>
                                @endif
                            @endif
                        </section>
                    @endif

                @else
                    <section class="Home-request ">
                        <p>SOLICITAR CRÉDITO PERSONAL</p>
                        {{ Form::open(['route' => 'credit', 'method' => 'post', 'role' => 'form', 'class'=>'Login-form','id'=>'loginForm']) }}
                        <div class="">
                            {{Form::label('identification_card','Número de Cédula.',array('id'=>'email'))}}
                            {{Form::text('identification_card','',['id' => 'identification_card'])}}
                        </div>

                        <div>
                            <div class="Remember">
                                <a id="Remember" href="">Como funciona?</a>
                            </div>
                            <button class="home-button" id="signUpButton-home">
                                IDENTIFICARSE
                            </button>
                        </div>
                        {{ Form::close() }}

                    </section>
                @endif

            </div>
        </div>

        {{-- <div class="content-Request">
             <a href="{{asset('credito')}}">
                 <img src="{{asset('img/footer2.jpg')}}">
             </a>
         </div>--}}
    </div>
@stop

@section('javascript')
    {{ HTML::script('js/slider.js'); }}
@stop
