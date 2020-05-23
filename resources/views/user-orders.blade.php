@extends('layouts.front')

@section('content')
    <div class="container bg0 p-t-75 p-b-85">
    <div class="row">
        <div class="col-12">
            <hr>
            <h2>Meus Pedidos</h2>

            <div class="col-12">
            </div>
            </div>
            @forelse($userOders as $key => $order)
                <div class="col-12">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <strong class="mb-0 ">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                                        Pedido n°: {{$order->reference}}
                                    </button>
                                </strong>
                            </div>
                            <div id="collapse{{$key}}" class="collapse @if($key == 0) show @endif " aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Status do Pedido:</strong>
                                                @if($order->pedido_status == 1)
                                                Processando
                                                <div class="progress" style="margin-bottom: 5px;">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%"></div>
                                                </div>
                                                @elseif ($order->pedido_status == 2)
                                                Aguardando pagamento
                                                <div class="progress" style="margin-bottom: 5px;">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%"></div>
                                                </div>
                                                @elseif ($order->pedido_status == 3)
                                                Em separação
                                                <div class="progress" style="margin-bottom: 5px;">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                                                </div>
                                                @elseif ($order->pedido_status == 4)
                                                Enviado
                                                <div class="progress" style="margin-bottom: 5px;">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                                                </div>
                                                @endif
                                                @if ($order->pedido_status == 1)
                                                <p><strong>Status do Pagamento:</strong> Aguardando PagSeguro</p>
                                                @elseif($order->pedido_status == 2)
                                                <p><strong>Status do Pagamento:</strong> Em análise</p>
                                                @elseif($order->pedido_status == 3)
                                                <p><strong>Status do Pagamento:</strong> Pago</p>
                                                @elseif($order->pedido_status == 4)
                                                <p><strong>Status do Pagamento:</strong> Disponível</p>
                                                @elseif($order->pedido_status == 5)
                                                <p><strong>Status do Pagamento:</strong> Em disputa</p>
                                                @elseif($order->pedido_status == 6)
                                                <p><strong>Status do Pagamento:</strong> Devolvida</p>
                                                @elseif($order->pedido_status == 7)
                                                <p><strong>Status do Pagamento:</strong> Cancelada</p>
                                                @endif

                                        </div>

                                        <div class="col-md-3">
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
                                        <div class="col-md-3">
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
