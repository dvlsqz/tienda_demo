@extends('connect.master')

@section('title','Recuperar Contraseña')

@section('content')
    <div class="box box_login shadow">

        <div class="header">
            <a href="{{url('/')}}">
                <img src="{{url('/static/imagenes/logo.png')}}" alt="">
            </a>
        </div>

        <div class="inside">
            {!! Form::open(['url' => '/reset']) !!}

            <label for="email">Correo Electrónico</label>
            <div class="input-group">
                <div class="input-group-prepend">
                <div class="input-group-text"><i class="far fa-envelope"></i></div>
                </div>
                {!! Form::email('email', $email, ['class' => 'form-control', 'required'])!!}
            </div>

            <label for="code" class="mtop16">Código de Recuperación</label>
            <div class="input-group">
                <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-key"></i></div>
                </div>
                {!! Form::number('code', null, ['class' => 'form-control', 'required'])!!}
            </div>

            {!! Form::submit('Enviar nueva contraseña', ['class' => 'btn btn-success mtop16']) !!}
            {!! Form::close() !!}

            @if(Session::has('message'))
                <div class="container">
                    <div class="mtop16 alert alert-{{ Session::get('typealert') }}" style="display:none;">
                        {{ Session::get('message') }}
                        @if( $errors->any() )
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <script>
                            $('.alert').slideDown();
                            setTimeout(function(){ $('.alert').slideUp(); },10000);
                        </script>
                    </div>
                </div>
            @endif

            <div class="footer mtop16">
                <a href="{{url('/register')}}">¿No tienes una cuenta?, Registrate</a>
                <a href="{{url('/login')}}">Ingresar a mí cuenta</a>
            </div>
        </div>

        
    </div>
@stop