@extends('emails.master')

@section('content')
<p>Hola: <strong>{{ $name }} </strong></p>
<p>Su orden <strong>#{{ $o_number}}</strong> fue marcada como: <strong> {{ getOrderStatus($status) }} </strong></p>

@if($status == "6")
    <p>¡Muchas gracias por tu compra y confiar en nosotros!</p>
@endif


@stop 