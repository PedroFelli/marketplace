@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Meus Pedidos</h2>
            <hr>
            <div class="col-12">
            </div>
        </div>
            @forelse($userOders as $key => $order)
                <div class="col-12">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <strong class="mb-0 ">
                                    Pedido n°: {{$order->reference}}
                                    <button class="btn btn-info float-right" type="button" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </strong>
                            </div>
                            <div id="collapse{{$key}}" class="collapse @if($key == 0) show @endif " aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm">
                                            <strong>Status do Pedido:</strong>
                                                @if($order->pagseguro_status == 3)
                                                <div class="progress" style="margin-bottom: 5px;">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%"></div>
                                                </div>
                                                    <p><strong>Status do pagamento:</strong> Em Análise</p>
                                                @else ($order->pagseguro_status == 1)
                                                <div class="progress" style="margin-bottom: 5px;">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%"></div>
                                                </div>
                                                <p><strong>Status do pagamento:</strong> Completo</p>
                                                @endif
                                        </div>
                                        <div class="col-sm">
                                            @php
                                                $items = unserialize($order->items);
                                                $total = 0;
                                            @endphp
                                            @foreach( $items as $item)
                                                <li>{{$item['name']}} | R$: {{number_format($item['price']*$item['amount'], 2, ',','.')}}
                                                    <br>
                                                    <p class="text-muted">Quantidade: {{$item['amount']}}</p>
                                                </li>
                                                @php
                                                    $totalItems = $item['price']*$item['amount'];
                                                    $total +=$totalItems;
                                                @endphp
                                            @endforeach
                                        </div>
                                        <div class="col-sm">
                                            <p> Data do pedido: {{$order->created_at->format('d-m-Y')}}</p>
                                            <p>Valor do pedido: {{$total}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        @empty
            <div class="alert alert-warning">Nenhum pedido recebido</div>
        @endforelse



        <hr>
        {{$userOders->links()}}
    </div>

@endsection
{{--<div class="row">--}}
{{--    <div class="col-12">--}}
{{--        <h2>Meus Pedidos</h2>--}}
{{--        <hr>--}}
{{--    </div>--}}

{{--    @empty--}}
{{--        <div class="alert alert-warning">Nenhum pedido recebido</div>--}}
{{--    @endforelse--}}
{{--</div>--}}


{{--@forelse($userOders as $key => $order)--}}
{{--    <div class="col-12" style="margin-bottom: 15px;">--}}
{{--        <div class="card">--}}
{{--            <div class="card-body">--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
