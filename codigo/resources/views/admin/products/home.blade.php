@extends('admin.master')
@section('title','Productos')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products') }}" class="nav-link"><i class="fas fa-boxes"></i> Productos</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-boxes"></i> Productos</h2>
                <ul>
                    @if(kvfj(Auth::user()->permissions, 'product_add'))
                        <li>
                            <a href="{{ url('/admin/products/add') }}" ><i class="fas fa-plus-circle"></i> Agregar Producto</a>
                        </li>
                    @endif 
                    <li>
                        <a href="#"><i class="fas fa-chevron-down"></i> Filtar</a>
                        <ul class="shadow">
                            <li><a href="{{url('/admin/products/1')}}"><i class="fas fa-globe-americas"></i> Públicos</a></li>
                            <li><a href="{{url('/admin/products/0')}}"><i class="fas fa-eraser"></i> Borradores</a></li>
                            <li><a href="{{url('/admin/products/trash')}}"><i class="fas fa-trash"></i> Papelera</a></li>
                            <li><a href="{{url('/admin/products/all')}}"><i class="fas fa-list-ul"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" id="btn_search" ><i class="fas fa-search"></i> Buscar</a>
                        
                    </li>
                </ul>
            </div>

            <div class="inside">
                <div class="form_search" id="form_search">
                    {!! Form::open(['url'=> '/admin/product/search']) !!}
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su busqueda', 'required']) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::select('filter',['0'=>'Nombre del Producto', '1'=>'Código del Producto'], 0, ['class' => 'form-select']) !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::select('status',['0'=>'Borrador', '1'=>'Público'], 0, ['class' => 'form-select']) !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::submit('Buscar', ['class'=>'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                
                
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>OPCIONES</td>
                            <td>ID</td>
                            <td>IMAGEN</td>
                            <td>NOMBRE</td>
                            <td>PRECIO</td>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @foreach($products as $p)
                            <tr>
                                <td width="160">
                                    <div class="opts">
                                        @if(kvfj(Auth::user()->permissions, 'product_edit'))
                                            <a href="{{ url('/admin/product/'.$p->id.'/edit') }}" data-toogle="tooltrip" data-placement="top" title="Editar" class="edit"><i class="fas fa-pencil-alt"></i></a>
                                        @endif    
                                        @if(kvfj(Auth::user()->permissions, 'product_inventory'))
                                            <a href="{{ url('/admin/product/'.$p->id.'/inventory') }}" data-toogle="tooltrip" data-placement="top" title="Inventario" class="inventory"><i class="fas fa-box"></i> </a>                                    
                                        @endif  
                                        @if(kvfj(Auth::user()->permissions, 'product_delete'))
                                            @if(is_null($p->deleted_at))
                                                <a href="#" data-action="delete" data-path="admin/product" data-object="{{ $p->id }}" data-toogle="tooltrip" data-placement="top" title="Eliminar" class="btn-deleted deleted"><i class="fas fa-trash-alt"></i></a>
                                            @else
                                                <a href="{{ url('/admin/product/'.$p->id.'/restore') }}" data-action="restore" data-path="admin/product" data-object="{{ $p->id }}" data-toogle="tooltrip" data-placement="top" title="Restaurar" class="btn-deleted restore"><i class="fas fa-trash-restore"></i></a>
                                            @endif
                                        @endif 
                                    </div>
                                </td>
                                <td width="50">{{ $p->id }}</td>
                                <td width="48">
                                    <a href="{{ getUrlFileFromUploads($p->image) }}" data-fancybox="gallery">
                                        <img src="{{ getUrlFileFromUploads($p->image) }}" width="48">
                                    </a>
                                </td>
                                <td>
                                    <p style="margin-bottom: 0px;"> {{ $p->name }} @if($p->status == "0") <i class="fas fa-eraser" data-toogle="tooltrip" data-placement="top" title="Estado: Borrado"></i> @endif </p> 
                                    @if($p->cat->name)
                                        <p> <small><i class="fas fa-folder-open"></i> {{ $p->cat->name }} @if($p->subcategory_id != 0 ) <i class="fas fa-angle-double-right"></i> {{ $p->getSubCategory->name }} @endif </small>  </p>
                                    @endif
                                </td>
                                <td>{{ config('cms.currency') }} {{ $p->price }} </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="6"> {!! $products->render() !!} </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection