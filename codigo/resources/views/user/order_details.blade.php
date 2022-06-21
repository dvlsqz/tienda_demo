@extends('master')
@section('title','Orden #'.$order->o_number)

@section('content')
<div class="cart mtop32">
    <div class="container">
        <div class="items mtop32">                
            <div class="row">
                <div class="col-md-9">
                    <div class="panel">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-shopping-cart"></i> Detalle de la Orden #{{ $order->o_number }} </h2>
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
                        </div>
                    </div>
                </div>

                
                <div class="col-md-3">
                    
                    <div class="panel">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-map-marker-alt"></i> Tipo de Entrega </h2>
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

                    <div class="panel mtop16">
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

                    <div class="panel mtop16">
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
</div>
@endsection