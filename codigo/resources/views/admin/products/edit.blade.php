@extends('admin.master')
@section('title','Editar Producto')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products') }}" class="nav-link"><i class="fas fa-boxes"></i> Productos</a>
    </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-9">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-edit"></i> Editar Producto</h2>
                </div>

                <div class="inside">
                    {!! Form::open(['url'=>'/admin/product/'.$p->id.'/edit', 'files'=>true]) !!}
                        <div class="row">

                            <div class="col-md-12">
                                <label for="name">Nombre del Producto:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('name', $p->name, ['class'=>'form-control']) !!}
                                </div>
                            </div>

                        </div>
                        
                        <div class="row mtop16">
                            <div class="col-md-6">
                                <label for="category">Categoría Principal:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    {!! Form::select('category', $cats, $p->category_id,['class'=>'form-select', 'id' => 'category']) !!}
                                    {!! Form::hidden('subcategory_actual', $p->subcategory_id, ['id' => 'subcategory_actual']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="category">Sub Categoría:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    {!! Form::select('subcategory', [], null,['class'=>'form-select', 'id' => 'subcategory', 'required']) !!}
                                </div>
                            </div>

                        </div>

                        <div class="row mtop16">

                            <div class="col-md-3">
                                <label for="indiscount">¿En Descuento?:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-percentage"></i></span>
                                    {!! Form::select('indiscount', ['0'=>'No','1'=>'Si'],$p->in_discount,['class'=>'form-select']) !!}
                                </div>  
                            </div>

                            <div class="col-md-3">
                                <label for="discount">Descuento:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-coins"></i></span>
                                    {!! Form::number('discount', $p->discount , ['class'=>'form-control','min'=>'0.00', 'step'=>'any']) !!}
                                </div>  
                            </div>

                            <div class="col-md-3">
                                <label for="discount_until_date">Fecha Limite de Descuento:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-coins"></i></span>
                                    {!! Form::date('discount_until_date', $p->discount_until_date, ['class'=>'form-control']) !!}
                                </div>  
                            </div>

                            

                            <div class="col-md-3">
                                <label for="name">Imagen Destacada:</label>
                                <div class="form-file">
                                    {!! Form::file('img', ['class'=>'form-file-input', 'id'=>'customFile', 'accept'=>'image/*']) !!}
                                    <label class="form-file-label" for="inputGroupFile01">
                                        <span class="form-file-text">Choose file...</span>
                                        <span class="form-file-button">Buscar</span>
                                    </label>
                                </div>
                            </div>

                        </div>

                        <div class="row mtop16">     

                            <div class="col-md-3">
                                <label for="code">Codígo en el Sistema:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-coins"></i></span>
                                    {!! Form::text('code', $p->code, ['class'=>'form-control']) !!}
                                </div>  
                            </div>                      

                            <div class="col-md-3">
                                <label for="status">Estado:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-file"></i></span>
                                    {!! Form::select('status', ['0'=>'Borrador','1'=>'Publico'],$p->status,['class'=>'form-select']) !!}
                                </div>  
                            </div>
                            
                        </div>

                        <div class="row mtop16">
                            <div class="col-md-12">
                                <label for="name">Descripción:</label>                                
                                    {!! Form::textarea('content', $p->content, ['class'=>'form-control','id'=>'editor']) !!}
                            </div>
                        </div>

                        <div class="row mtop16">
                            <div class="col-md-12">
                                {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
                            </div>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="far fa-image"></i> Imagen Destacada</h2>
                </div>

                <div class="inside">
                    <img src="{{ getUrlFileFromUploads($p->image) }}" class="img-fluid">
                </div>
            </div>

            <div class="panel shadow mtop16">
                <div class="header">
                    <h2 class="title"><i class="fas fa-images"></i> Galería</h2>
                </div>

                <div class="inside product_gallery">
                    @if(kvfj(Auth::user()->permissions, 'product_gallery_add'))
                        {!! Form::open(['url' => '/admin/product/'.$p->id.'/gallery/add', 'files' => true, 'id'=>'form_product_gallery']) !!}

                        {!! Form::file('file_image', ['id' => 'product_file_image', 'accept' => 'image/*', 'style' => 'display:none', 'required' ]) !!}

                        {!! Form::close() !!}
                    
 
                        <div class="btn-submit">
                            <a href="#" id="btn_product_file_image"><i class="fas fa-plus-circle"></i></a>
                        </div>
                    @endif

                    <div class="tumbs">
                        @foreach($p->getGallery as $img)
                            <div class="tumb">
                                @if(kvfj(Auth::user()->permissions, 'product_gallery_delete'))
                                    <a href="{{ url('/admin/product/'.$p->id.'/gallery/'.$img->id.'/delete') }}" data-toogle="tooltrip" data-placement="top" title="Eliminar">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                @endif
                                <img src="{{ getUrlFileFromUploads($img->file_name) }}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection