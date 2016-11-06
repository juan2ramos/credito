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
                <th>Creditos</th>
                <th>Emprendedoras</th>
                <th>Eliminar</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($points as $point)
                <tr>
                    <td>{{$point->name}}</td>
                    <td><input name="isCredit" type="checkbox" value="{{$point->id}}" @if($point->isCreditShop) checked @endif class="isCredit"></td>
                    <td><input name="isEnterpricing" type="checkbox" value="{{$point->id}}" @if($point->isEnterpricingShop) checked @endif class="isEnterpricing"></td>
                    <td><a href="{{route('pointDelete', [$point->id])}}" class="icon-trash-empty"></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="Input-more">

        {{Form::open(array('route'=>'point','method'=>'POST'))}}
            {{ Form::select('location_id', $locations,'',array('class'=>'Credit-select')) }}

        @if($errors->first('location_id'))
            <div class="errors" style="margin-top: 0">
                *{{$errors->first('location_id')}}
            </div>
        @endif
        {{Form::text('name','',['id' => 'Input-more','placeholder' => 'Ingrese una nueva region'])}}
        @if($errors->first('name'))
            <div class="errors" style="margin-top: 0 !important;">
                *{{$errors->first('name')}}
            </div>
        @endif
        <button class="u-more">+</button>
        {{Form::close()}}
    </div>
@stop

@section('javascript')
    {{ HTML::script('js/slider.js'); }}
    <script>
        $('.isEnterpricing').on('click', function(){

            var checked = $(this).is(':checked') ? "1" : "0";
            var params = {
                _token : "prueba",
                id : $(this).val(),
                check : checked,
                type : 1
            };

            $.get( "/admin/updatepoint", params )
                .done(function(data) {
                    console.log( "actualizado");
                })
                .error(function(){
                    alert("ha ocurrido un error");
                });
        });

        $('.isCredit').on('click', function(){

            var checked = $(this).is(':checked') ? "1" : "0";
            var params = {
                _token : "prueba",
                id : $(this).val(),
                check : checked,
                type : 2
            };

            $.get( "/admin/updatepoint", params )
                    .done(function(data) {
                        console.log( "actualizado");
                    })
                    .error(function(){
                        alert("ha ocurrido un error");
                    });
        });
    </script>
@stop