@extends('admin.master')
@section('title','Ordenes de Compra #'.$order->o_number)

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/orders/all/all') }}" class="nav-link"><i class="fas fa-clipboard-list"></i> Ordenes de Compra</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#" class="nav-link"><i class="fas fa-clipboard-list"></i> Ordenes de Compra # {{ $order->o_number }}</a>
    </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="order">
        <div class="row">
            <div class="col-md-3"> 
                <div class="panel shadow">
        
                    <div class="header">
                        <h2 class="title"><i class="fas fa-user-circle"></i> Usuario</h2>
                    </div>

                    <div class="inside">
                        <div class="profile">
                            <div class="photo">
                                @if(is_null($order->getUser->avatar)) 
                                    <img src="{{ url('/static/imagenes/default-avatar.png') }}" class="img-fluid rounded-circle">
                                @else
                                    <img src="{{ url('/uploads_users/'.$order->getUser->id.'/av_'.$order->getUser->avatar ) }}" class="img-fluid rounded-circle">
                                @endif
                            </div>

                            <div class="info mtop16"> 
                                <ul>
                                    <li> <i class="fas fa-user-circle"></i><strong> Nombre:</strong> {{ $order->getUser->name.' '.$order->getUser->lastname }}</li>
                                    <li> <i class="fas fa-mail-bulk"></i><strong> Email:</strong> {{ $order->getUser->email }}</li>
                                    @if($order->getUser->phone)
                                        <li> <i class="fas fa-phone-square"></i><strong> Teléfono:</strong> {{ $order->getUser->phone }}</li>
                                    @endif
                                </ul>

                                <a href="{{ url('/admin/user/'.$order->getUser->id.'/view') }}" class="btn btn-primary btn-sm mtop16"> Ver Usuario</a>
                            </div>

                        </div>

                    </div>
                    
                </div>
                
                <div class="panel shadow mtop16">
        
                    <div class="header">
                        <h2 class="title"><i class="fas fa-map-marker"></i> Tipo de Orden</h2>
                    </div>

                    <div class="inside">
                        @if($order->o_type == "0")
                            <p style="margin-bottom: 2px"><strong> Departamento: </strong> {{ $order->getUserAddress->getState->name }} </p>
                            <p style="margin-bottom: 2px"><strong> Municipio: </strong> {{ $order->getUserAddress->getCity->name }} </p>
                            <p style="margin-bottom: 2px"> 
                                <strong> Dirección: </strong>
                                {{ kvfj($order->getUserAddress->addr_info, 'add1') }} 
                                zona {{ kvfj($order->getUserAddress->addr_info, 'add2') }}
                                {{ kvfj($order->getUserAddress->addr_info, 'add3') }}
                            </p>
                            <p style="margin-bottom: 2px"> 
                                <strong> Referencia: </strong>
                                {{ kvfj($order->getUserAddress->addr_info, 'add4') }}
                            </p>
                        @endif

                        
                        <div class="mcswtich mtop16">
                            <a href="#" class="sl @if($order->o_type == "0") active @endif">
                                <i class="fas fa-shipping-fast"></i> Domicilio
                            </a>                                        
                            <a href="#" class="sl @if($order->o_type == "1") active @endif">
                                <i class="fas fa-people-carry"></i> Recoger
                            </a>                                        
                        </div>

                    </div>
                    
                </div>
            </div>

            <div class="col-md-6"> 
                <div class="panel shadow">
        
                    <div class="header">
                        <h2 class="title"><i class="fas fa-clipboard-list"></i> Lisatdo de Ordenes de Compra</h2>
                    </div>

                    <div class="inside"> 
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <td width="80"></td>
                                    <td><strong>PRODUCTO</strong></td>
                                    <td width="160"><strong>CANTIDAD</strong></td>
                                    <td width="124"><strong>SUBTOTAL</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->getItems as $item)
                                <tr>
                                    <td>
                                        <img src="{{ url('/uploads/'.$item->getProduct->file_path.'/t_'.$item->getProduct->image) }}" class="img-fluid rounded">
                                    </td>
                                    <td>
                                        <a href="{{ url('/product/'.$item->getProduct->id.'/'.$item->getProduct->slug) }}">
                                            {{ $item->label_item }}
                                            
                                            <div class="price_discount">
                                                Precio: 

                                                @if($item->discount_status == "1")
                                                    <span class="price_initial">{{ config('cms.currency').number_format($item->price_initial, 2, '.', ',' ) }} </span> /
                                                @endif

                                                <span class="price_discount_unit">
                                                    {{ config('cms.currency').number_format($item->price_unit , 2, '.', ',' ) }} 

                                                    @if($item->discount_status == "1")
                                                        ({{ $item->discount}}% de descuento)
                                                    @endif 

                                                </span>
                                            </div>
                                            
                                        </a>
                                    </td>
                                    <td> {{ $item->quantity}} </td>
                                    <td><strong>{{ number($item->total) }}</strong></td>
                                </tr>
                                @endforeach

                                <tr>
                                    <td colspan="2"></td>
                                    <td><strong>Subtotal: </strong></td>
                                    <td><strong>{{ number($order->getSubtotal()) }}</strong> </td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td><strong>Envió: </strong></td>
                                    <td><strong>{{ number($order->delivery) }} </strong> </td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td><strong>Total a pagar: </strong></td>
                                    <td><strong>{{ number($order->total)}} </strong> </td>
                                </tr>
                            </tbody>
                        </table>

                        @if(kvfj(Auth::user()->permissions, 'order_change_status'))
                            <div class="order_status mtop16">
                                @if($order->status == '6' || $order->status == '100')
                                    {!! Form::open(['url' => '#', 'disabled']) !!}               
                                @else
                                    {!! Form::open(['url' => '/admin/order/'.$order->id.'/view']) !!}
                                @endif
                                    <div class="row">
                                        <div class="col-md-12">
                                            <strong>Estado de la Orden</strong>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8">
                                            @if($order->o_type == "0")
                                                {!! Form::select('status', Arr::except(getOrderStatus(), ['0', '5']), $order->status, ['class' => 'form-select'] ) !!}
                                            @else
                                                {!! Form::select('status', Arr::except(getOrderStatus(), ['0', '4']), $order->status, ['class' => 'form-select'] ) !!}
                                            @endif
                                        </div>

                                        <div class="col-md-4">
                                            @if($order->status == '6' || $order->status == '100')
                                                {!! Form::submit('Actualizar', ['class' => 'btn btn-success w-100', 'disabled']) !!}               
                                            @else
                                                {!! Form::submit('Actualizar', ['class' => 'btn btn-success w-100']) !!}
                                            @endif                                            
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        @endif

                    </div>
                </div>            
            </div>

            <div class="col-md-3"> 
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-credit-card"></i> Metodos de Pago </h2>
                    </div>

                    <div class="inside">
                        <div class="payments_methods">
                            <a href="#" class=" w-100 active" id="payment_method_cash" data-payment-method-id="0">
                                <i class="fas fa-money-bill-alt"></i> {{ getPaymentsMethods($order->payment_method) }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="panel shadow mtop16">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-calendar-alt"></i> Actividades </h2>
                    </div>

                    <div class="inside">
                        <div class="profile">
                            <div class="info">
                                <ul>
                                    <li><strong><i class="far fa-clock"></i> Solicitida: </strong> {{ $order->request_at }} </li>
                                    <li><strong><i class="far fa-credit-card"></i> Pagada: </strong> {{ $order->paid_at }} </li>
                                    <li><strong><i class="fas fa-box"></i> Procesando: </strong> {{ $order->process_at }} </li>
                                    
                                    @if($order->o_type == "0")
                                        <li><strong><i class="fas fa-motorcycle"></i> Enviada: </strong> {{ $order->send_at }} </li>
                                    @else 
                                        <li><strong><i class="fas fa-motorcycle"></i> Lista: </strong> {{ $order->send_at }} </li>
                                    @endif
                                    
                                    <li><strong><i class="fas fa-shipping-fast"></i> Entregada: </strong> {{ $order->delivery_at }} </li>
                                    
                                    @if($order->rejected_at)
                                        <li><strong><i class="fas fa-recycle"></i> Rechazada: </strong> {{ $order->rejected_at }} </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="panel shadow mtop16">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-envelope-open"></i> Más opciones </h2>
                    </div>

                    <div class="inside">
                        <label for="order_msg">Comentario:</label>
                        @if($order->user_comment)
                            <p>{!! $order->user_comment !!}</p>
                        @endif
                    </div>
                </div>   

            </div>
        </div>
    </div>
</div>
@endsection