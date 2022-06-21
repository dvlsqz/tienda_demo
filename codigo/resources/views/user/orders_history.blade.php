@extends('master')
@section('title','Historial de Compras')

@section('content')
<div class="row mtop32">
    <div class="col-md-12">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-history"></i> Historial de Compras</h2>
            </div>
            <div class="inside">
                <div class="edit_avatar">
                    <table class="table table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <td></td>
                                <td><strong>#</strong></td>
                                <td><strong>ESTADO</strong></td>
                                <td><strong>MÉTODO DE PAGO</strong></td>
                                <td><strong>TIPO</strong></td>
                                <td><strong>TOTAL</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(Auth::user()->getOrders as $order)
                                <tr>
                                    <td>
                                        <a href="{{ url('/account/history/order/'.$order->id) }}" data-toogle="tooltrip" data-placement="top" class="btn btn-primary btn-sm w-100" >
                                            <i class="fas fa-clipboard"></i> Ver Orden
                                        </a>
                                    </td>
                                    <td>{{ $order->o_number}}</td>
                                    <td>{{ getOrderStatus($order->status) }}</td>
                                    <td>{{ getPaymentsMethods($order->payment_method) }}</td>
                                    <td>{{ getOrderType($order->o_type) }}</td>
                                    <td>{{ number($order->total) }}</td>
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