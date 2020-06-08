@extends('layouts.app')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Pedidos</h1>
            <div class="card mb-4">
                <div class="card-header"><i class="fas fa-table mr-1"></i>Tabela produtos</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>N° do pedido</th>
                                <th>PagSeguro status</th>
                                <th>Status do pedido</th>
                                <th>Data</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>N° do pedido</th>
                                <th>PagSeguro Status</th>
                                <th>Pedido Status</th>
                                <th>Data</th>
                                <th>Ações</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @forelse($orders as $key => $order)
                                <tr>
                                    <td></td>
                                    <td>{{$order->reference}}</td>
                                    <td>{{$order->pagseguro_status}}</td>
                                    <td>{{$order->pedido_status}}</td>
                                    <td>{{$order->created_at->format('d-m-Y H:i')}}</td>

                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('admin.orders.edit', ['order' => $order->id])}}" class="btn btn-sm btn-info">EDITAR</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-warning">Nenhum pedido recebido</div>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>
{{--    <div class="row">--}}
{{--        <div class="col-12">--}}
{{--            <h2>Pedidos Recebidos</h2>--}}
{{--            <hr>--}}
{{--        </div>--}}
{{--        @forelse($orders as $key => $order)--}}
{{--        <div class="col-12">--}}
{{--            <div class="accordion" id="accordionExample">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header" id="headingOne">--}}
{{--                        <h2 class="mb-0">--}}
{{--                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapseOne">--}}
{{--                              Pedido n°: {{$order->reference}}--}}
{{--                            </button>--}}
{{--                        </h2>--}}
{{--                    </div>--}}

{{--                    <div id="collapse{{$key}}" class="collapse @if($key == 0) show @endif " aria-labelledby="headingOne" data-parent="#accordionExample">--}}
{{--                        <div class="card-body">--}}
{{--                            <ul>--}}
{{--                                @php $items = unserialize($order->items);  @endphp--}}
{{--                                @foreach( filterItemsByStore($items, auth()->user()->store->id) as $item)--}}
{{--                                    <li>{{$item['name']}} | R$: {{number_format($item['price']*$item['amount'], 2, ',','.')}}--}}
{{--                                        <br>--}}
{{--                                        <p class="text-muted">Quantidade: {{$item['amount']}}</p>--}}
{{--                                    </li>--}}
{{--                                @endforeach--}}

{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}
{{--    <div class="col-12">--}}
{{--        <hr>--}}
{{--        --}}
{{--    </div>--}}

@endsection
