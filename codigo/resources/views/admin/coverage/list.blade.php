@extends('admin.master')
@section('title','Coberturas de envió')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/coverage') }}" class="nav-link"><i class="fas fa-shipping-fast"></i> Coberturas de envió</a>
    </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="panel shadow">

                <div class="header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i> Nuevo Departamento</h2>
                </div>

                <div class="inside">
                    @if(kvfj(Auth::user()->permissions, 'coverage_add'))
                        {!! Form::open(['url' => '/admin/coverage/state/add/']) !!}
                            <label for="name">Nombre:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('name', null, ['class'=>'form-control']) !!}
                            </div>

                            <label for="price" class="mtop16"> Días estimados de entrega:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::number('days', 0, ['class'=>'form-control', 'min' => '0', 'step' => 'any']) !!}
                            </div>

                            {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}

                        {!! Form::close() !!}
                    @endif
                </div>

            </div>
        </div>

        <div class="col-md-9">
            <div class="panel shadow">

                <div class="header">
                    <h2 class="title"><i class="fas fa-shipping-fast"></i> Listado de coberturas de envios</h2>
                </div>

                <div class="inside">
                    <table class="table mtop16">
                        <thead>
                            <tr>
                                <td ><strong>OPCIONES</strong></td>
                                <td ><strong>NOMBRE</strong></td>
                                <td><strong>TIEMPO DE ENTREGA </strong></td>
                                <td><strong>ESTADO</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($states as $state)
                                <tr>
                                    <td>
                                        <div class="opts">
                                            @if(kvfj(Auth::user()->permissions, 'coverage_edit'))
                                                <a href="{{ url('/admin/coverage/state/'.$state->id.'/edit') }}" data-toogle="tooltrip" data-placement="top" title="Editar" class="edit"><i class="fas fa-edit"></i></a>
                                                <a href="{{ url('/admin/coverage/'.$state->id.'/cities') }}" data-toogle="tooltrip" data-placement="top" title="Municipios" class="inventory"><i class="fas fa-list-ul"></i></a>
                                            @endif
                                            @if(kvfj(Auth::user()->permissions, 'coverage_delete'))
                                                <a href="{{ url('/admin/coverage/'.$state->id.'/delete') }}" data-action="delete" data-path="admin/coverage" data-object="{{ $state->id }}" data-toogle="tooltrip" data-placement="top" title="Eliminar" class="btn-deleted deleted"><i class="fas fa-trash-alt"></i></a>
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $state->name }}</td>
                                    <td>{{ $state->days }} día(s)</td>
                                    <td>{{ getCoverageStatus($state->status) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection