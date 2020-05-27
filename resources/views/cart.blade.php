@extends('layouts.front')

@section('content')
    <div class="bg0 p-t-75 p-b-85">
        @if($cart)
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-1">Produto</th>
                                <th class="column-2"></th>
                                <th class="column-3">Detalhes</th>
                                <th class="column-4">Quantidade</th>
                                <th class="column-5">Ação</th>
                                <th class="column-5">Total</th>
                            </tr>

                            @php $total = 0; @endphp
                            @foreach($cart as $c)

                            <tr class="table_row">
                                <td class="column-1">
                                    <div class="how-itemcart1">
                                        <img src="{{asset('storage/'.$c['photo'])}}" alt="IMG">
                                    </div>
                                </td>
                                <td class="column-2">{{$c['name']}}</td>
                                <td class="column-2">
                                   <p >Cor: {{$c['color']}}<br>
                                    Tamanho: {{$c['size']}}<br>
                                    Valor: R$ {{number_format(($c['price']),2 ,',','.')}}<br>
                                   </p>
                                </td>
                                <td class="column-4">{{$c['amount']}}</td>

                                <td class="column-5">
                                    <a href="{{route('cart.remove', ['slug' => $c['slug']])}}" class="btn btn-sm btn-danger">
                                        Remover
                                    </a>
                                </td>

                                @php
                                    $subtotal = $c['price'] * $c['amount'];
                                    $total += $subtotal;
                                @endphp
                                <td class="column-5">R$ {{number_format(($c['price']*$c['amount']),2 ,',','.')}}</td>
                            </tr>
                            @endforeach

                        </table>
                    </div>
                    <!-- INICIO CODIGO PAGSEGURO -->
                    <a href="https://pagseguro.uol.com.br/desenvolvedor/simulador_de_frete.jhtml?CepOrigem=75083470&amp;Peso=1&amp;Valor=0,00" id="ps_freight_simulator" target="_blank"><img src="https://p.simg.uol.com.br/out/pagseguro/i/user/imgCalculoFrete.gif" id="imgCalculoFrete" alt="Cálculo automático de frete" border="0" /></a>
                    <script type="text/javascript" src="https://p.simg.uol.com.br/out/pagseguro/j/simulador_de_frete.js"></script>
                    <!-- FINAL CODIGO PAGSEGURO -->
                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                        <a href="{{route('checkout.index')}}">
                            <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                               Finalizar compra
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="container">
            <div class="row">



            </div>
        </div>
        @else
            <div class="container">
                <div class="alert alert-warning col-8" style="margin: auto;">Carrinho vazinho</div>
            </div>
        @endif
    </div>
@endsection
