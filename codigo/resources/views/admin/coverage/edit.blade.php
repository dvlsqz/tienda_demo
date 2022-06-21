@extends('admin.master')
@section('title','Editar - Coberturas de envió')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/coverage') }}" class="nav-link"><i class="fas fa-shipping-fast"></i> Editar Coberturas de envió</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/coverage/state/'.$coverage->id.'/edit') }}" class="nav-link"><i class="fas fa-edit"></i> Editar Coberturas a: {{ $coverage->name }}</a>
    </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="panel shadow">

                <div class="header">
                    <h2 class="title"><i class="fas fa-edit"></i> Editar Cobertura de envió</h2>
                </div>

                <div class="inside">
                    @if(kvfj(Auth::user()->permissions, 'coverage_edit'))
                        {!! Form::open(['url' => '/admin/coverage/state/'.$coverage->id.'/edit']) !!}
                            <label for="name">Nombre:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('name', $coverage->name, ['class'=>'form-control']) !!}
                            </div>

                            <label for="price" class="mtop16"> Días estimados de entrega:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::number('days',$coverage->days, ['class'=>'form-control', 'min' => '0', 'step' => 'any']) !!}
                            </div>

                            <label for="status" class="mtop16"> Estado:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                {!! Form::select('status', getCoverageStatus(), $coverage->status, ['class' => 'form-select'] ) !!}
                            </div>

                            {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}

                        {!! Form::close() !!}
                    @endif
                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="panel shadow">

                <div class="header">
                    <h2 class="title"><i class="fas fa-shipping-fast"></i> Información general</h2>
                </div>

                <div class="inside">
                    @if($coverage->ctype == "0")
                        <p><strong>Tipo de Cobertura: </strong> Departamento </p>
                        <p><strong>Nombre: </strong> {{ $coverage->name}} </p>
                        
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

@endsection