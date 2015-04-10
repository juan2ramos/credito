@extends('layout/front')
@section('title') Contenidos @stop
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
    @if( Session::get('message_error') )
        <script>
            var notify = document.getElementById('notify');
            notify.classList.add('is-show');
            notify.classList.add('error');
            notify.querySelector('.text-notify').innerText = '{{Session::get('message_error')}}';
        </script>
    @endif
    <h1>Puntos de Ventas</h1>
    <div class="Table-content">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Eliminar</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($points as $point)
                <tr>
                    <td>{{$point->name}}</td>
                    <td>{{ HTML::link(URL::to('puntos/'.$point->id), '',array('class'=>'icon-trash-empty','onClick'=>"return confirm('Estas seguro de eliminar el punto de venta?')")) }}</td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>

    <div class="Input-more">

        {{Form::open(array('route'=>'point','method'=>'POST'))}}
            {{ Form::select('location_id', $locations,'',array('class'=>'Credit-select')) }}

        @if($errors->first('location_id'))
            <div class="errors">
                *{{$errors->first('location_id')}}
            </div>
        @endif
        {{Form::text('name','',['id' => 'Input-more','placeholder' => 'Ingrese una nueva region'])}}
        @if($errors->first('name'))
            <div class="errors">
                *{{$errors->first('name')}}
            </div>
        @endif
        <button class="u-more">+</button>
        {{Form::close()}}
    </div>
@stop

@section('javascript')
    {{ HTML::script('js/slider.js'); }}
@stop