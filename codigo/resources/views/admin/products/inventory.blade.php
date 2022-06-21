@extends('admin.master')
@section('title','Inventario de Producto')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/1') }}" class="nav-link"><i class="fas fa-boxes"></i> Productos</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/'.$product->id.'/edit') }}" class="nav-link"><i class="fas fa-boxes"></i> {{ $product->name }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/'.$product->id.'/inventory') }}" class="nav-link"><i class="fas fa-box"></i> Inventario</a>
    </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-box"></i> Crear Inventario</h2>
                </div>

                <div class="inside">
                    {!! Form::open(['url' => '/admin/product/'.$product->id.'/inventory']) !!}

                        <label for="name">Nombre:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('name', null, ['class'=>'form-control']) !!}
                        </div>

                        <label for="inventory" class="mtop16">Cantida en Inventario:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::number('inventory', 1, ['class'=>'form-control', 'min' => '1']) !!}
                        </div>

                        <label for="price" class="mtop16">Precio:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">{{ config('cms.currency') }}.</span>
                            {!! Form::number('price', 1.00, ['class'=>'form-control', 'min' => '1', 'step' => 'any']) !!}
                        </div>

                        <label for="limited" class="mtop16">Limite de Inventario:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            {!! Form::select('limited', ['0' => 'Limitado', '1' => 'Ilimitado'], 0,['class'=>'form-select']) !!}
                        </div>

                        <label for="minium" class="mtop16">Inventario Minimo:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::number('minium', 1, ['class'=>'form-control', 'min' => '1']) !!}
                        </div>

                        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-box"></i> Lista Inventarios</h2>
                </div>

                <div class="inside">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>OPCIONES</td>
                                <td>ID</td>
                                <td>NOMBRE</td>
                                <td>EXISTENCIAS</td>
                                <td>MÍNIMO</td>
                                <td>PRECIO</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product->getInventory as $inventory)
                                <tr>
                                    <td width="160">
                                        <div class="opts">
                                            <a href="{{ url('/admin/product/inventory/'.$inventory->id.'/edit') }}" data-toogle="tooltrip" data-placement="top" title="Editar" class="edit"><i class="fas fa-pencil-alt"></i></a>
                                            
                                            <a href="#" data-action="delete" data-path="admin/product/inventory" data-object="{{ $inventory->id }}" data-toogle="tooltrip" data-placement="top" title="Eliminar" class="btn-deleted deleted"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                    <td>{{ $inventory->id }}</td>
                                    <td>{{ $inventory->name }}</td>
                                    <td>
                                        @if($inventory->limited == "1")
                                            Ilimitada
                                        @else
                                            {{ $inventory->quantity }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($inventory->limited == "1")
                                            Ilimitada
                                        @else
                                            {{ $inventory->minium }}
                                        @endif
                                    </td>
                                    <td>{{ config('cms.currency') }} {{ $inventory->price }}</td>
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