@extends('layout/front')

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
    @if($errors->first() )
        <script>
            var notify = document.getElementById('notify');
            notify.classList.add('is-show');
            notify.classList.add('error');
            notify.querySelector('.text-notify').innerText = 'Los datos son correctos';
        </script>
    @endif

    <h1>Variables generales</h1>

    <section class="acceptSection">
        <div class="Table-content">
            <table class="table table-striped table-hover ">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Valor minimo</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($variables as $variable)
                        <tr>
                            {{Form::open(array('url'=>'variables/'.$variable->id,'method'=>'POST','class'=>"variables"))}}
                            <td>{{$variable->name}}</td>
                            <td class="variable"><p class="p1">{{$variable->value}}</p>{{form::text('value',$variable->value,array('class'=>'hidden variableText1'))}}</td>
                        </tr>
                        {{form::close()}}
                    @endforeach


                </tbody>
            </table>
        </div>

    </section>
    <section class="">



    </section>

@stop
@section('javascript')
    {{ HTML::script('js/variables.js'); }}
@stop
