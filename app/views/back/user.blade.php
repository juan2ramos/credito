@extends('layout.front')
@section('content')
    {{$user->name}}
    @if($credits)
        @foreach($credits as $credit)
            {{$credit->id}}
        @endforeach
    @endif
@stop