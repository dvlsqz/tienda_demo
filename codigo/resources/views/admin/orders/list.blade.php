@extends('admin.master')
@section('title','Ordenes de Compra')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/orders/'.$status) }}" class="nav-link"><i class="fas fa-clipboard-list"></i> Ordenes de Compra</a>
    </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3"> 
            <div class="panel shadow">
    
                <div class="header">
                    <h2 class="title"><i class="fas fa-filter"></i> Filtrar por Estado</h2>
                </div>

                <div class="list-group">
                    <a href="{{ url('admin/orders/all/'.$type) }}" class="list-group-item list-group-item-action @if($status == 'all') active @endif" aria-current="true">
                        <i class="fas fa-chevron-right"></i> Todas <span class="badge bg-primary rounded-pill"> {{ $all_orders->count() }} </span>
                    </a>
                    @foreach(Arr::except(getOrderStatus(), ['0']) as  $key => $value)
                        <a href="{{ url('admin/orders/'.$key.'/'.$type) }}" class="list-group-item list-group-item-action @if($status == $key) active @endif" aria-current="true">
                            <i class="fas fa-chevron-right"></i> {{ $value }}
                            <span class="badge bg-primary rounded-pill"> {{ $all_orders->where('status', $key)->count() }} </span>
                        </a>
                    @endforeach
                </div>
            </div>            
        </div>

        <div class="col-md-9"> 
            <div class="panel shadow">
    
                <div class="header">
                    <h2 class="title"><i class="fas fa-clipboard-list"></i> Lisatdo de Ordenes de Compra</h2>
                </div>

                <div class="inside">
                    <ul class="nav nav-pills nav-fill">
                        <li class="nav-item">
                            <a class="nav-link @if( $type == 'all') active @endif " aria-current="page" href="{{ url('/admin/orders/'.$status.'/all') }}"> Todas</a>
                        </li>
                        @foreach(getOrderType() as $key => $value)
                            <li class="nav-item">
                                <a class="nav-link @if( $type == $key) active @endif" aria-current="page" href="{{ url('/admin/orders/'.$status.'/'.$key) }}"> {{ $value }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <table class="table mtop16">
                        <thead>
                            <tr>
                                <td></td>                                
                                <td><strong>#</strong></td>
                                <td><strong>FECHA</strong></td>
                                <td><strong>Usuario</strong></td>
                                <td><strong>TIPO</strong></td>
                                <td><strong>TOTAL</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>
                                        <a href="{{ url('/admin/order/'.$order->id.'/view') }}" class="btn btn-primary btn-sm">Abrir</a>
                                    </td>                                    
                                    <td>{{ $order->o_number }}</td>
                                    <td>{{ $order->request_at}}</td>
                                    <td>{{ $order->getUser->name.' '.$order->getUser->lastname }}</td>
                                    <td>{{ getOrderType($order->o_type) }}</td>
                                    <td>{{ number($order->total) }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="6">{!! $orders->render() !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>            
        </div>
    </div>
</div>
@endsection