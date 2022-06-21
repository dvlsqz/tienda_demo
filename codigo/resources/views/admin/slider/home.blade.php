@extends('admin.master')
@section('title','Sliders')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/sliders') }}" class="nav-link"><i class="fas fa-images"></i> Sliders</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
        
            <div class="col-md-4">
                @if(kvfj(Auth::user()->permissions, 'sliders_add'))
                    <div class="panel shadow">

                        <div class="header">
                            <h2 class="title"><i class="fas fa-plus-circle"></i> Agregar Slider</h2>
                        </div>

                        <div class="inside">
                            
                            {!! Form::open(['url' => '/admin/slider/add', 'files' => true]) !!}
                                <label for="name">Nombre:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                                </div>

                                <label for="visible" class="mtop16">Visible:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    {!! Form::select('visible', ['0' => 'No visible', '1' => 'Visible'], 1 ,['class'=>'form-select']) !!}
                                </div>

                                <label for="image" class="mtop16">Imagen Destacada:</label>
                                <div class="form-file">
                                    {!! Form::file('image', ['class'=>'form-file-input',  'id'=>'customFile', 'accept'=>'image/*']) !!}
                                    <label class="form-file-label" for="inputGroupFile01">
                                        <span class="form-file-text">Choose file...</span>
                                        <span class="form-file-button">Buscar</span>
                                    </label>
                                </div>

                                <label for="content" class="mtop16">Contenido:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::textarea('content', null, ['class'=>'form-control', 'rows' => '3']) !!}
                                </div>

                                <label for="sorder" class="mtop16">Orden de Aparición:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::number('sorder', 0, ['class'=>'form-control', 'min' => '0']) !!}
                                </div>

                                {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}

                            {!! Form::close() !!}
                            
                        </div>

                    </div>
                @endif
            </div>

            <div class="col-md-8">
                <div class="panel shadow">

                    <div class="header">
                        <h2 class="title"><i class="fas fa-images"></i> Sliders</a>
                    </div>

                    <div class="inside">
                        <table class="table mtop16">
                            <thead>
                                <tr>
                                    <td width="140px">OPCIONES</td>
                                    <td width="48px">IMAGEN</td>
                                    <td>CONTENIDO</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sliders as $slider)
                                    <tr>
                                        <td>
                                        <div class="opts">
                                            @if(kvfj(Auth::user()->permissions, 'sliders_edit'))
                                                <a href="{{ url('/admin/slider/'.$slider->id.'/edit') }}" data-toogle="tooltrip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if(kvfj(Auth::user()->permissions, 'sliders_delete'))
                                                <a href="#" data-action="delete" data-path="admin/slider" data-object="{{ $slider->id }}" data-toogle="tooltrip" data-placement="top" title="Eliminar" class="btn-deleted"><i class="fas fa-trash-alt"></i></a>
                                            @endif
                                        </div>
                                        </td>
                                        <td width="180px">
                                            <img src="{{ url('/uploads/'.$slider->file_path.'/'.$slider->file_name) }}" class="img-fluid">
                                        </td>
                                        <td>
                                            <div class="slider_content">
                                                <h1>{{ $slider->name }}</h1>
                                                {!! html_entity_decode($slider->content) !!}
                                            </div>
                                        </td>
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