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
        <figure class="faq">
            <img src="{{asset('img/faq.png')}}">
        </figure>
        <div class="content-Request">
            <a href="{{asset('credito')}}">
                <img src="{{asset('img/footer.jpg')}}">
            </a>
        </div>

    </div>


@stop

@section('javascript')
    {{ HTML::script('js/slider.js'); }}
@stop
