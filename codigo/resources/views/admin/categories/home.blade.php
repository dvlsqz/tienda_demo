@extends('admin.master')
@section('title','Categorías')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/categories/0') }}" class="nav-link"><i class="fas fa-tags"></i> Categorías</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-4">
                <div class="panel shadow">

                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus-circle"></i> Agregar Categoría</h2>
                    </div>

                    <div class="inside">
                        @if(kvfj(Auth::user()->permissions, 'category_add'))
                            {!! Form::open(['url' => '/admin/category/add/'.$module, 'files' => true]) !!}
                                <label for="name">Nombre:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                                </div>

                                <label for="module" class="mtop16"> Categoría Principal:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    <select name="parent" class="form-select" >
                                        <option value="0">Sin Categoria Principal</option>
                                        @foreach($cats as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label for="module" class="mtop16">Módulo:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    {!! Form::select('module', getModulesArray(), $module,['class'=>'form-select', 'disabled']) !!}
                                </div>

                                <label for="icon" class="mtop16">Ícono:</label>
                                <div class="form-file">
                                    {!! Form::file('icon', ['class'=>'form-file-input', 'required', 'id'=>'customFile', 'accept'=>'image/*']) !!}
                                    <label class="form-file-label" for="inputGroupFile01">
                                        <span class="form-file-text">Choose file...</span>
                                        <span class="form-file-button">Buscar</span>
                                    </label>
                                </div>

                                {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}

                            {!! Form::close() !!}
                        @endif
                    </div>

                </div>
            </div>

            <div class="col-md-8">
                <div class="panel shadow">

                    <div class="header">
                        <h2 class="title"><i class="fas fa-tags"></i> Categorías</a>
                    </div>

                    <div class="inside">
                        <nav class="nav nav-pills nav-fill">
                            @foreach(getModulesArray() as $m => $k)
                                <a class="nav-link" href="{{ url('/admin/categories/'.$m) }}"><i class="fas fa-search"></i> {{ $k }}</a>
                            @endforeach
                        </nav>
                        <table class="table mtop16">
                            <thead>
                                <tr>
                                    <td width="156px">OPCIONES</td>
                                    <td width="48px">ÍCONO</td>
                                    <td>NOMBRE</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cats as $cat)
                                    <tr>
                                        <td>
                                            <div class="opts">
                                                @if(kvfj(Auth::user()->permissions, 'category_edit'))
                                                    <a href="{{ url('/admin/category/'.$cat->id.'/edit') }}" data-toogle="tooltrip" data-placement="top" title="Editar" class="edit"><i class="fas fa-edit"></i></a>
                                                    <a href="{{ url('/admin/category/'.$cat->id.'/subs') }}" data-toogle="tooltrip" data-placement="top" title="Sub Categorias" class="inventory"><i class="fas fa-list-ul"></i></a>
                                                @endif
                                                @if(kvfj(Auth::user()->permissions, 'category_delete'))
                                                    <a href="{{ url('/admin/category/'.$cat->id.'/delete') }}" data-action="delete" data-path="admin/category" data-object="{{ $cat->id }}" data-toogle="tooltrip" data-placement="top" title="Eliminar" class="btn-deleted deleted"><i class="fas fa-trash-alt"></i></a>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            @if(!is_null($cat->icon))
                                                <img src="{{ getUrlFileFromUploads($cat->icon) }}" class="img-fluid">
                                            @endif
                                        </td>
                                        <td>{{ $cat->name }}</td>
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