@extends('layouts.app')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Atualizar Pedido</h1>
            <form action="{{route('admin.products.store')}}" method="post" >


                <div class="form-group">
                    <label>Nome usuario</label>
                    <input type="text" name="name" class="form-control" disabled value="{{$user->name}}">
                </div>

                <div class="form-group">
                    <label>Status do Pedido:</label>
                    <select class="form-control" name="pedido_status" >
                        <option value="1" @if($order->pedido_status == 1) selected @endif>Processando</option>
                        <option value="2" @if($order->pedido_status == 2) selected @endif> Aguardando pagamento</option>
                        <option value="3" @if($order->pedido_status == 3) selected @endif>Em separação</option>
                        <option value="4" @if($order->pedido_status == 4) selected @endif>Enviado</option>
                    </select>
                </div>
                    @if($order->pedido_status == 1)
                        <div class="progress" style="margin-bottom: 5px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%"></div>
                        </div>
                    @elseif ($order->pedido_status == 2)
                        <div class="progress" style="margin-bottom: 5px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%"></div>
                        </div>
                    @elseif ($order->pedido_status == 3)
                        <div class="progress" style="margin-bottom: 5px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                        </div>
                    @elseif ($order->pedido_status == 4)
                        <div class="progress" style="margin-bottom: 5px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                        </div>
                    @endif

                <div class="form-group">
                    <label>Status do Pagamento:</label>
                    @if ($order->pedido_status == 1)
                        <input type="text" name="name" class="form-control" disabled value="Aguardando PagSeguro">
                    @elseif($order->pedido_status == 2)
                        <input type="text" name="name" class="form-control" disabled value="Em análise">
                    @elseif($order->pedido_status == 3)
                        <input type="text" name="name" class="form-control" disabled value="Pago">
                    @elseif($order->pedido_status == 4)
                        <input type="text" name="name" class="form-control" disabled value="Disponível">
                    @elseif($order->pedido_status == 5)
                        <input type="text" name="name" class="form-control" disabled value=" Em disputa">
                    @elseif($order->pedido_status == 6)
                        <input type="text" name="name" class="form-control" disabled value="Devolvida">
                    @elseif($order->pedido_status == 7)
                        <input type="text" name="name" class="form-control" disabled value="Cancelada">

                    @endif
                </div>
                <div class="form-group">
                    <label>PagSeguro Code:</label>
                    <input type="text" name="name" class="form-control" disabled value="{{$order->pagseguro_code}}">
                </div>
                <hr>
                <div class="form-group">
                    <label>Codigo de rastreio:</label>
                    <input type="text" name="name" class="form-control"  value="" placeholder="31313132131321">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            Enviar notificação
                        </label>
                    </div>
                </div>
                <hr>
                <strong>Items:</strong>
                @php $items = unserialize($order->items);  @endphp
                @foreach( filterItemsByStore($items, auth()->user()->store->id) as $item)
                    <p>
                        Produto: {{$item['name']}}<br>
                        R$: {{number_format($item['price']*$item['amount'], 2, ',','.')}}<br>
                        Quantidade: {{$item['amount']}}
                    </p>

                @endforeach



                <div>
                    <button type="submit" class="btn  btn-success">Atualizar pedido</button>
                </div>
            </form>
            <hr>

        </div>
    </main>


@endsection
