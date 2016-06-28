@extends('layout.front')
@section('content')
    @include('layout.notify')
    @if(Session::get('message'))

        <script>
            var notify = document.getElementById('notify');
            notify.classList.add('is-show');
            notify.classList.add('success');
            notify.querySelector('.text-notify').innerText = '{{Session::get('message')}}';
        </script>
    @endif
    @if($errors->first() or Session::get('message_error'))
        <script>
            var notify = document.getElementById('notify');
            notify.classList.add('is-show');
            notify.classList.add('error');
            @if( Session::get('message_error'))
            notify.querySelector('.text-notify').innerText = '{{Session::get('message_error')}}';
            @endif
            notify.querySelector('.text-notify').innerText = 'Los datos estan incorrectos {{$errors->first('identification_card')}} {{$errors->first('email')}}{{$errors->first('name')}} {{Session::get('message_error')}}';
        </script>
    @endif
    <div class="Back-content">
        {{ HTML::link(URL::to('admin/usuarios'), 'atras',array('class'=>'login-button')) }}
    </div>


    <section class="update-user u-shadow-5">

        <h1>Datos del usuario</h1>
        @if(Auth::user()->roles_id>1)
            {{Form::open(array('url'=>'Actualizar/'.$user->id,'method'=>'POST','class'=>"User-form",'files'=>true))}}
        @else
            {{Form::open(array('url'=>'admin/uploadUser/'.$user->id,'method'=>'POST','class'=>"User-form",'files'=>true))}}
        @endif
        @if(Auth::user()->roles_id==1 or Auth::user()->roles_id==3 )
            @if($user->roles_id==4)
                <div class="material-header">
                    <div class="material-item">
                        <!-- Espacio reservado para generar paz y salvos -->
                    </div>
                    <div class="material-card">
                        {{Form::label('card','ENTREGAR TARJETA LILIPINK')}}
                        {{form::text('card', $user->card ,array('class'=>' variableText1'))}}
                        {{$errors->first('card')}}
                    </div>
                    <div class="material-item fingerprint">
                        <div id="dropzone">
                            @if($user->fingerprint)
                                <img src="{{url('users/' . $user->fingerprint)}}">
                            @else
                                <div>HUELLA</div>
                                {{form::file('fingerprint', ['accept' => 'image/jpeg, image/png'])}}
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        @endif
        @if(Auth::user()->roles_id == 3)
            <button class="u-button" style="width: 200px; display: block; margin: 2rem auto 1rem;">
                Actualizar # tarjeta
            </button>
        @endif

        <section class="User-section ">

            {{form::text('id', $user->id,array('class'=>'hidden'))}}
            @if(empty($user->user_name))
                <?php $user->user_name = $user->identification_card;?>
            @endif
            {{form::text('user_name', $user->user_name,array('class'=>'hidden'))}}


            <div class="material-input">
                {{form::text('identification_card', $user->identification_card,array('class'=>' variableText1', $disabled))}}
                {{Form::label('identification_card','Cedula')}}
                <span></span>
            </div>

            @if($errors->first('identification_card'))
                <div class="errors">
                    *{{$errors->first('identification_card')}}
                </div>
            @endif

            <div class="material-input">
                {{form::text('name', $user->name ,array('class'=>' variableText1', $disabled ))}}
                {{Form::label('name','Nombre')}}
                <span></span>
            </div>

            @if($errors->first('name'))
                <div class="errors">
                    *{{$errors->first('name')}}
                </div>
            @endif

            <div class="material-input">
                {{form::text('second_name', $user->second_name ,array('class'=>' variableText1', $disabled))}}
                {{Form::label('second_name','Segundo nombre')}}
                <span></span>
            </div>

            @if($errors->first('second_name'))
                <div class="errors">
                    *{{$errors->first('second_name')}}
                </div>
            @endif

            <div class="material-input">
                {{form::text('last_name', $user->last_name ,array('class'=>' variableText1', $disabled))}}
                {{Form::label('last_name','Apellido')}}
                <span></span>
            </div>

            @if($errors->first('last_name'))
                <div class="errors">
                    *{{$errors->first('last_name')}}
                </div>
            @endif

            <div class="material-input">
                {{form::text('second_last_name', $user->second_last_name ,array('class'=>' variableText1', $disabled))}}
                {{Form::label('second_last_name','Segundo apellido')}}
                <span></span>
            </div>

            @if($errors->first('second_last_name'))
                <div class="errors">
                    *{{$errors->first('second_last_name')}}
                </div>
            @endif

            <div class="material-input">
                {{form::text('email', $user->email ,array('class'=>'variableText1', $disabled))}}
                {{Form::label('email','E-mail')}}
                <span></span>
            </div>

            @if($errors->first('email'))
                <div class="errors">
                    *{{$errors->first('email')}}
                </div>
            @endif

            <div class="material-input hidden">
                {{form::text('user_name', $user->user_name ,array('class'=>'variableText1', $disabled))}}
                {{Form::label('user_name','Username')}}
                <span></span>
            </div>

            <div class="material">
                {{Form::label('photo','Foto')}}
                {{Form::file('photo',['id'=>'photo', $disabled])}}
            </div>

            @if($errors->first('photo'))
                <div class="errors">
                    *{{$errors->first('photo')}}
                </div>
            @endif

            @foreach($credits as $credit)
                @if($credit->user_id==$user->id)
                    <div class="material-input ">
                        {{form::text('monto aprobado', '$'.$credit->value ,array('class'=>'variableText1'))}}
                        {{Form::label('monto','monto aprobado')}}
                        <span></span>
                    </div>
                @endif
            @endforeach

        </section>

        <section class="User-section ">


            <div class="material-input">
                {{form::text('address', $user->address ,array('class'=>' variableText1', $disabled))}}
                {{Form::label('address','Direccion')}}
                <span></span>
            </div>

            @if($errors->first('address'))
                <div class="errors">
                    *{{$errors->first('address')}}
                </div>
            @endif

            <div class="material-input">
                {{form::text('residency_city', $user->residency_city ,array('class'=>' variableText1', $disabled))}}
                {{Form::label('residency_city','Ciudad de residencia')}}
                <span></span>
            </div>

            @if($errors->first('residency_city'))
                <div class="errors">
                    *{{$errors->first('residency_city')}}
                </div>
            @endif

            <div class="material-input">
                {{form::text('birth_city', $user->birth_city ,array('class'=>' variableText1', $disabled))}}
                {{Form::label('birth_city','Ciudad de nacimiento')}}
                <span></span>
            </div>

            @if($errors->first('birth_city'))
                <div class="errors">
                    *{{$errors->first('birth_city')}}
                </div>
            @endif

            <div class="material-input">
                {{form::text('mobile_phone', $user->mobile_phone ,array('class'=>' variableText1', $disabled))}}
                {{Form::label('mobile_phone','Celular')}}
                <span></span>
            </div>

            @if($errors->first('mobile_phone'))
                <div class="errors">
                    *{{$errors->first('mobile_phone')}}
                </div>
            @endif

            <div class="material-input">
                {{form::text('phone', $user->phone ,array('class'=>' variableText1', $disabled))}}
                {{Form::label('phone','telefono')}}
                <span></span>
            </div>

            @if($errors->first('phone'))
                <div class="errors">
                    *{{$errors->first('phone')}}
                </div>
            @endif


            <div class="material-input">
                {{Form::input('date','date_birth',$user->date_birth,['class'=>' variableText1','id' => 'date_birth', $disabled])}}
                {{Form::label('date_birth','fecha de nacimiento')}}
                <span></span>
            </div>
            @if($errors->first('date_birth'))
                <div class="errors">
                    *{{$errors->first('date_birth')}}
                </div>
            @endif

            <div class="material-input">
                {{ Form::select('location', $locations,$user->location,array('class'=>'Credit-select', $disabled)) }}
                <span></span>
            </div>

            @if($errors->first('location'))
                <div class="errors">
                    *{{$errors->first('location')}}
                </div>
            @endif
            @foreach($credits as $credit)
                @if($credit->user_id==$user->id)
                    @foreach($points as $point)
                        @if($credit->point==$point->id)
                            <div class="material-input">
                                {{Form::input('point','point',$point->name,['class'=>' variableText1','id' => 'date_birth'])}}
                                {{Form::label('point','punto de venta')}}
                                <span></span>
                            </div>

                        @endif
                    @endforeach
                @endif

            @endforeach


        </section>


        @if(Auth::user()->roles_id<3)
            <button class="u-button">
                Actualizar datos
            </button>
        @endif

        {{form::close()}}

        <div class="Table-content">
            <table class="table table-striped table-hover ">
                <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Punto de Venta</th>
                    <th>Tasa de interes</th>
                    <th>Valor de la Compra</th>
                    <th>Cargos y abonos</th>
                    <th>Saldo del Credito</th>
                    <th>Cuotas</th>
                    <th>Saldo sin Vencer</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($extracts as $extract)
                    @if($extract->nit==$user->identification_card)
                        <tr>
                            <td>{{$extract->nit}}</td>
                            <td>{{$extract->punto_venta}}</td>
                            <td>{{$extract->tasa_interes}}</td>
                            <td>{{$extract->valor_compra}}</td>
                            <td>{{$extract->cargos_abonos}}</td>
                            <td>{{$extract->saldo_credito_diferido}}</td>
                            <td>{{$extract->cuotas}}</td>
                            <td>{{$extract->saldo_sin_vencer}}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
        <section style="  margin: 26px;  padding: 10px;">
            <p>Dias vencidos: {{$vencidos}} dias</p>

            <p>Deuda pendiente por pagar: $ {{$debe}}</p>
            @if(!$debe)
                <form action="{{route('peace', $user->id)}}" method="post">
                    <button class="u-button" style="cursor:pointer; width: 200px">Descargar paz y salvo</button>
                </form>
            @endif
        </section>
        @if(isset($credits[0]))
            <details style="text-align: center">
                <summary><h2>Credito solicitado</h2></summary>
                <p>Estado: {{$credits[0]->state}}</p>

                <p>Prioridad: {{$credits[0]->priority}}</p>

                <p>Egresos Mensuales: {{$credits[0]->monthly_expenses}}</p>

                <p>Ingresos Mensuales: {{$credits[0]->monthly_income}}</p>

                <p>Direccion de la oficina: {{$credits[0]->office_address}}</p>

                <p>Lugar de expedicion: {{$credits[0]->instead_expedition}}</p>

                <p>Fecha de expedicion: {{$credits[0]->date_expedition}}</p>

                <h3>Referencia 1</h3>

                <p>Nombre: {{$credits[0]->name_reference}}</p>

                <p>Telefono: {{$credits[0]->phone_reference}}</p>

                <h3>Referencia 2</h3>

                <p>Nombre: {{$credits[0]->name_reference}}</p>

                <p>Telefono: {{$credits[0]->phone_reference}}</p>

            </details>
        @endif
        @if(isset($credits[0]))
            {{Form::open(array('url'=>'admin/updateValueCredit/'.$user->id,'method'=>'POST','class'=>"User-form",'files'=>true))}}
            <div class="material-input" style = "max-width: 300px; margin: 2rem auto;" >

                {{Form::input('numeric','creditValue',$credits[0]->value,['class'=>' variableText1'])}}
                {{Form::label('creditValue','Valor del crédito aprobado')}}
                <span></span>

            </div>
            <button class="u-button">
                Actualizar credito
            </button>
            {{Form::close()}}
        @else
            No tiene crédito aprobado
        @endif
    </section>


@stop

@section('javascript')

    {{ HTML::script('js/variables.js'); }}
    {{ HTML::script('js/credit.js'); }}
    <script>
        $(function() {
            $('#dropzone input').on('change', function(e) {
                var file = this.files[0];

                if (this.accept && $.inArray(file.type, this.accept.split(/, ?/)) == -1) {
                    return alert('Tipo de archivo no permitido.');
                }

                $('#dropzone img').remove();

                if ((/^image\/(gif|png|jpeg)$/i).test(file.type)) {
                    var reader = new FileReader(file);

                    reader.readAsDataURL(file);

                    reader.onload = function(e) {
                        var data = e.target.result,
                                $img = $('<img />').attr('src', data).fadeIn();

                        $('#dropzone div').html($img);
                    };
                } else {
                    var ext = file.name.split('.').pop();

                    $('#dropzone div').html(ext);
                }
            });
        });
    </script>
@stop