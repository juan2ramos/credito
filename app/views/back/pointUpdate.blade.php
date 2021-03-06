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
    <h1>Punto de Venta</h1>
    <div class="Table-content">
        {{Form::open(array('route'=>['pointUpdate',$point->id],'method'=>'POST','style'=>'margin: 40px'))}}
        <input style="padding: 10px;width: 500px" name="name" type="text" placeholder="" value="{{$point->name}}">
        <input type="hidden" name="id" value="{{$point->id}}">
        <select name="location_id" id="" style="border: 1px solid #dfdfdf;height: 39px;margin: 0 4px;">
            @foreach($locations as $location)
                <option value="{{$location->id}}" @if($location->id == $point->location_id) selected @endif>{{$location->name}}</option>
            @endforeach
        </select>
        <input class="u-button" type="submit" value="Actualizar nombre" style="width: auto;padding: 11px;">
        {{Form::close()}}
    </div>


@stop
