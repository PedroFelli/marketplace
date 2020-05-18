@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Pedidos Recebidos</h2>
            <hr>
        </div>
        @forelse($orders as $key => $order)
        <div class="col-12">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                              Pedido n°: {{$order->reference}}
                            </button>
                        </h2>
                    </div>

                    <div id="collapse{{$key}}" class="collapse @if($key == 0) show @endif " aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                @php $items = unserialize($order->items);  @endphp
                                @foreach( filterItemsByStore($items, auth()->user()->store->id) as $item)
                                    <li>{{$item['name']}} | R$: {{number_format($item['price']*$item['amount'], 2, ',','.')}}
                                        <br>
                                        <p class="text-muted">Quantidade: {{$item['amount']}}</p>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <div class="alert alert-warning">Nenhum pedido recebido</div>
        @endforelse
    </div>
    <div class="col-12">
        <hr>
        {{$orders->links()}}
    </div>

@endsection
