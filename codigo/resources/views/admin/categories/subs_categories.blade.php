@extends('admin.master')
@section('title','Categorías')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/categories/0') }}" class="nav-link"><i class="fas fa-tags"></i> Categorías</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#" class="nav-link"><i class="fas fa-tags"></i> Categoría: {{ $cat->name }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#" class="nav-link"><i class="fas fa-tags"></i> Sub Categorías</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="panel shadow">

                    <div class="header">
                        <h2 class="title"><i class="fas fa-tags"></i> Sub Categorías de <strong>{{ $cat->name }}</strong> </a>
                    </div>

                    <div class="inside">
                        <table class="table mtop16">
                            <thead>
                                <tr>
                                    <td width="156px">OPCIONES</td>
                                    <td width="48px">ÍCONO</td>
                                    <td>NOMBRE</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cat->getSubcategories as $cat)
                                    <tr>
                                        <td>
                                        <div class="opts">
                                            @if(kvfj(Auth::user()->permissions, 'category_edit'))
                                                <a href="{{ url('/admin/category/'.$cat->id.'/edit') }}" data-toogle="tooltrip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if(kvfj(Auth::user()->permissions, 'category_delete'))
                                                <a href="{{ url('/admin/category/'.$cat->id.'/delete') }}" data-toogle="tooltrip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
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