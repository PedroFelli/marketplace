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
<<<<<<< HEAD
                    <div class="wrap-table-shopping-cart">
                        <div class="size-208" style="padding-left: 15px; padding-top: 10px;">
                            <span class="mtext-101 cl2" >
								Calcular frete
							</span>
                            <div class="bor8 bg0 m-b-22" style="margin-top: 8px;" >
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Cep">
                            </div>
                        </div>
                    </div>
=======
                    <!-- INICIO CODIGO PAGSEGURO -->
                    <a href="https://pagseguro.uol.com.br/desenvolvedor/simulador_de_frete.jhtml?CepOrigem=75083470&amp;Peso=1&amp;Valor=0,00" id="ps_freight_simulator" target="_blank"><img src="https://p.simg.uol.com.br/out/pagseguro/i/user/imgCalculoFrete.gif" id="imgCalculoFrete" alt="Cálculo automático de frete" border="0" /></a>
                    <script type="text/javascript" src="https://p.simg.uol.com.br/out/pagseguro/j/simulador_de_frete.js"></script>
                    <!-- FINAL CODIGO PAGSEGURO -->
>>>>>>> 2c2ee3dd7bfff9b8028c5ac2151c3018c3a04ec0
                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                        <a href="{{route('checkout.index')}}">
                            <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                               Calcular frete
                            </div>
                            <div id="frete"></div>
                        </a>
                        <a href="{{route('checkout.index')}}">
                            <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                Finalizar compra
                            </div>
                        </a>
                    </div>
                </div>

            </div>

            <button>Send an HTTP GET request to a page and get the result back</button>

    </div>
        @else
            <div class="container">
                <div class="alert alert-warning col-8" style="margin: auto;">Carrinho vazinho</div>
            </div>
        @endif
    </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script type="text/javascript" src="js/xml2json.min.js"></script>
            <script>
                $(document).ready(function(){
                    $("button").click(function(){
                        var x2js = new X2JS();
                        $.ajax({
                            url: "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?&sCepOrigem=75083470&sCepDestino=08226021&nVlPeso=1&nCdFormato=1&nVlComprimento=20&nVlAltura=20&nVlLargura=20&sCdMaoPropria=n&nVlValorDeclarado=100,&sCdAvisoRecebimento=n&nCdServico=04510&nVlDiametro=0&StrRetorno=xml&nIndicaCalculo=3p",
                            dataType: "xml",
                            success: function(data) {
                                var xmlText = data; // XML
                                var jsonData = x2js.xml2json(xmlText); // Convert XML to JSON
                                console.log(jsonData.Servicos.cServico);
                            }
                        });
                    });
                });
            </script>
@endsection
