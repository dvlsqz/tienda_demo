@extends('admin.master')
@section('title','Editar Usuario')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/users') }}" class="nav-link"><i class="fas fa-user-lock"></i> Usuarios</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="page_user">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-info-circle"></i> Información</h2>
                        </div>

                        <div class="inside">
                            <div class="mini_profile">
                                @if(is_null($u->avatar)) 
                                    <img src="{{ url('/static/imagenes/default-avatar.png') }}" class="avatar">
                                @else
                                    <img src="{{ url('/uploads_users/'.$u->id.'/av_'.$u->avatar ) }}" class="avatar">
                                @endif
                                <div class="info">
                                    <span class="title"><i class="fas fa-id-card"></i> Nombre:</span>
                                    <span class="text">{{ $u->name.' '.$u->lastname}}</span>

                                    <span class="title"><i class="fas fa-user-tie"></i> Estado del Usuario:</span>
                                    <span class="text">{{ getUserStatusArray(null, $u->status) }}</span>

                                    <span class="title"><i class="fas fa-envelope"></i> Correo Electrónico:</span>
                                    <span class="text">{{ $u->email}}</span>

                                    <span class="title"><i class="far fa-calendar-alt"></i> Fecha de Registró:</span>
                                    <span class="text">{{ $u->created_at }}</span>

                                    <span class="title"><i class="fas fa-user-shield"></i> Rol de Usuario:</span>
                                    <span class="text">{{ getRoleUserArray(null, $u->role) }}</span>
                                </div>
                                @if(kvfj(Auth::user()->permissions, 'user_banned'))
                                    @if($u->status == '100')
                                        <a href="{{ url('/admin/user/'.$u->id.'/banned') }}" class="btn btn-success">Activar Usuario</a>
                                    @else
                                        <a href="{{ url('/admin/user/'.$u->id.'/banned') }}" class="btn btn-danger">Suspender Usuario</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-clipboard-list"></i> Historial de Compras</h2>
                        </div>

                        <div class="inside">
                            <table class="table mtop16">
                                <thead>
                                    <tr>
                                        <td></td>                                
                                        <td><strong>#</strong></td>
                                        <td><strong>FECHA</strong></td>
                                        <td><strong>ESTADO</strong></td>
                                        <td><strong>TIPO</strong></td>
                                        <td><strong>TOTAL</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($u->getOrders as $order)
                                        <tr>
                                            <td>
                                                @if(kvfj(Auth::user()->permissions, 'order_view'))
                                                    <a href="{{ url('/admin/order/'.$order->id.'/view') }}" class="btn btn-primary btn-sm">Abrir</a>
                                                @endif
                                            </td>                                    
                                            <td>{{ $order->o_number }}</td>
                                            <td>{{ $order->request_at}}</td>
                                            <td>{{ getOrderStatus($order->status) }}</td>
                                            <td>{{ getOrderType($order->o_type) }}</td>
                                            <td>{{ number($order->total) }}</td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="panel shadow mtop16">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-edit"></i> Editar Información</h2>
                        </div>

                        <div class="inside">
                            @if(kvfj(Auth::user()->permissions, 'user_edit'))
                                {!! Form::open(['url'=> '/admin/user/'.$u->id.'/edit']) !!}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="module" class="mtop16">Tipo de Usuario:</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                                {!! Form::select('user_type', getRoleUserArray('list', null),$u->role,['class'=>'form-select']) !!}
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row mtop16">
                                        <div class="col-md-12">
                                            {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>        
    </div>

@endsection