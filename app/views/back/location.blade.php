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
    @if($errors->first('name') or Session::get('messages') )
        <script>
            var notify = document.getElementById('notify');
            notify.classList.add('is-show');
            notify.classList.add('error');
            notify.querySelector('.text-notify').innerText = '{{$errors->first('name').Session::get('messages') }}';
        </script>
    @endif
    <h1>Regiones</h1>
        <div class="Table-content">
            <table class="table table-striped table-hover ">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Eliminar</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($locations as $location)
                    <tr>
                        <td>{{$location->id}}</td>
                        <td>{{$location->name}}</td>
                        <td><input type="checkbox" checked></td>
                        <td><a href="{{route('deleteLocation', $location->id)}}" class="icon-trash-empty" onclick="return confirm('Estas seguro de eliminar la region?')"></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="Input-more">

            {{Form::open(['route'=>'location','method'=>'POST'])}}
            {{Form::text('name','',['id' => 'Input-more','placeholder' => 'Ingrese una nueva region'])}}
            <button class="u-more">+</button>
            {{Form::close()}}
        </div>
@stop

@section('javascript')
    {{ HTML::script('js/slider.js'); }}
@stop