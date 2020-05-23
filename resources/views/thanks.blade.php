@extends('layouts.front')

@section('content')
    <div class="container">
        <hr>
        <div class="card">
            <div class="card-header">
                Muito obrigado por sua compra!
            </div>
            <div class="card-body">
                <p class="card-text">Seu pedido esta sendo processado, código do pedido:<strong> {{request()->get('order')}}.</strong></p>
                <p class="mb-0">Enviamos os detalhes no seu email.</p>
                <a href="/my-orders" class="btn btn-primary">Ver meus pedidos</a>
            </div>
        </div>
    </div>
    <br/>
    <br>
@endsection
