@extends('master')
@section('title','Mis Direcciones de Entrega')

@section('content')
<div class="row mtop32">

    <div class="col-md-3">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-map-marker-alt"></i> Agregar Dirección</h2>
            </div>
            <div class="inside">
                {!! Form::open(['url'=>'/account/address/add']) !!}
                    <label for="name">Nombre:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    </div>

                    <label class="mtop16" for="gener">Departamento:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                        {!! Form::select('state', $states, null ,['class'=>'form-select', 'id' => 'state' ]) !!}
                    </div>

                    <label class="mtop16" for="gener">Municipio:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                        {!! Form::select('city', [], null ,['class'=>'form-select', 'id' => 'address_city']) !!}
                    </div>

                    <label class="mtop16" for="add1">Dirección:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                        {!! Form::text('add1', null, ['class'=>'form-control']) !!}
                    </div>

                    <label class="mtop16" for="add1">Zona:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                        {!! Form::text('add2', null, ['class'=>'form-control']) !!}
                    </div>

                    <label class="mtop16" for="add1">Barrio, colonia o residencial:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                        {!! Form::text('add3', null, ['class'=>'form-control']) !!}
                    </div>

                    <label class="mtop16" for="add1">Referencia:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                        {!! Form::text('add4', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="row mtop16">
                        <div class="col-md-12">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-map-marker-alt"></i> Mis Direcciones de Entrega</h2>
            </div>
            <div class="inside">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td></td>
                            <td><strong>NOMBRE</strong></td>
                            <td><strong>DEPARTAMENTO / CIUDAD</strong></td>
                            <td><strong>DIRECCIÓN</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Auth::user()->getAddress as $address)
                            <tr>
                                <td>
                                    @if($address->default == "0")
                                        <a href="#" class="btn-delete btn-deleted" data-object="{{ $address->id }}" data-action="delete" data-path="account/address"> <i class="far fa-trash-alt"></i> </a>
                                    @endif
                                </td>
                                <td>{{ $address->name }}</td>
                                <td> 
                                    <p>
                                        {{ $address->getState->name }} / {{ $address->getCity->name }}
                                    </p>
                                    <p>
                                        @if($address->default == "0")
                                            <a href=" {{ url('/account/address/'.$address->id.'/setdefault') }} ">Convertir en Principal</a>
                                        @else
                                            <p><small>Dirección Principal</small></p>
                                        @endif
                                    </p>
                                </td>
                                <td>
                                    <p><strong> Dirección: </strong> {{ kvfj($address->addr_info, 'add1') }}</p>
                                    <p><strong> Zona: </strong> {{ kvfj($address->addr_info, 'add2') }}</p>
                                    <p><strong> Barrio, colonia o residencial: </strong> {{ kvfj($address->addr_info, 'add3') }}</p>
                                    <p><strong> Referencia: </strong> {{ kvfj($address->addr_info, 'add4') }}</p>
                                
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>    
@endsection