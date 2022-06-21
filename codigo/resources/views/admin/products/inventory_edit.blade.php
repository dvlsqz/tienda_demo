@extends('admin.master')
@section('title','Inventario de Producto')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/1') }}" class="nav-link"><i class="fas fa-boxes"></i> Productos</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/'.$inventory->getProduct->id.'/edit') }}" class="nav-link"><i class="fas fa-boxes"></i> {{ $inventory->getProduct->name }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/'.$inventory->getProduct->id.'/inventory') }}" class="nav-link"><i class="fas fa-box"></i> Inventario</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/inventory'.$inventory->id.'/edit') }}" class="nav-link"><i class="fas fa-box"></i> {{ $inventory->name }}</a>
    </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-box"></i> Editar Inventario</h2>
                </div>

                <div class="inside">
                    {!! Form::open(['url' => '/admin/product/inventory/'.$inventory->id.'/edit']) !!}

                        <label for="name">Nombre:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('name', $inventory->name , ['class'=>'form-control']) !!}
                        </div>

                        <label for="inventory" class="mtop16">Cantida en Inventario:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::number('inventory', $inventory->quantity , ['class'=>'form-control', 'min' => '1']) !!}
                        </div>

                        <label for="price" class="mtop16">Precio:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">{{ config('cms.currency') }}.</span>
                            {!! Form::number('price', $inventory->price , ['class'=>'form-control', 'min' => '1', 'step' => 'any']) !!}
                        </div>

                        <label for="limited" class="mtop16">Limite de Inventario:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            {!! Form::select('limited', ['0' => 'Limitado', '1' => 'Ilimitado'], $inventory->limited ,['class'=>'form-select']) !!}
                        </div>

                        <label for="minium" class="mtop16">Inventario Minimo:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::number('minium', $inventory->minium, ['class'=>'form-control', 'min' => '1']) !!}
                        </div>

                        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-box"></i> Variantes</h2>
                </div>

                <div class="inside">
                    
                    {!! Form::open(['url'=>'/admin/product/inventory/'.$inventory->id.'/variant']) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('name', null , ['class'=>'form-control', 'placeholder' => 'Nombre de la variante']) !!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                    
                    <hr>

                    <table class="table">
                        <thead>
                            <tr>
                                <td>OPCIONES</td>
                                <td>ID</td>
                                <td>NOMBRE</td>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($inventory->getVariants as $variant)
                            <tr>
                                <td width="160">
                                    <div class="opts">
                                        <a href="#" data-action="delete" data-path="admin/product/variant" data-object="{{ $variant->id }}" data-toogle="tooltrip" data-placement="top" title="Eliminar" class="btn-deleted deleted"><i class="fas fa-trash-alt"></i></a>
                                    </div>
                                </td>
                                <td> {{ $variant->id }} </td>
                                <td> {{ $variant->name }} </td>
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