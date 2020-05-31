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
                                        <p>Cor: {{$c['color']}}<br>
                                            Tamanho: {{$c['size']}}<br>
                                            Valor: R$ {{number_format(($c['price']),2 ,',','.')}}<br>
                                        </p>
                                    </td>
                                    <td class="column-4">{{$c['amount']}}</td>

                                    <td class="column-5">
                                        <a href="{{route('cart.remove', ['slug' => $c['slug']])}}"
                                           class="btn btn-sm btn-danger">
                                            Remover
                                        </a>
                                    </td>


                                </tr>
                            @endforeach
                        </table>
                        <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                            <div>
                                <h4>Calcular frete </h4>

                                    <div class=" form-group">
                                        <label>CEP</label>
                                        <input name="cep" class="form-control" type="text" id="cep" value="" size="10" maxlength="9"
                                               onblur="pesquisacep(this.value);"  placeholder="00000-000" />
                                    </div>

                            </div>
                            <hr>
                            <div>
                                <span class="mtext-110 cl2">
								      Valor do frete:R$
							    </span>
                                <span class="mtext-101 cl2">
									<span id="valorFrete">00,00</span><br>
								</span>
                                <span class="mtext-110 cl2">
								      Prazo:
							    </span>
                                <span class="mtext-101 cl2">
									<span id="prazoFrete">0</span> Dias
								</span>
                            </div>

                        </div>
                        <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                            <div class="size-208">
								<span class="mtext-101 cl2">
									Total:
                                     <span class="mtext-101 cl2">
                                           @php
                                               $subtotal = $c['price'] * $c['amount'];
                                               $total += $subtotal;
                                           @endphp
									<span>
                                        <input id="totalCompra" disabled value="{{$total}}" style="background: none;">
                                    </span>
								</span>
								</span>
                            </div>
                            <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                <a href="{{route('cart.cancel')}}"  class=" btn">Cancelar Compra</a>
                            </div>
                            <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                <a href="{{route('checkout.step1')}}" class=" btn btnCheckout disabled">
                                        <button>Concluir Compra</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @else
        <div class="container">
            <div class="alert alert-warning col-8" style="margin: auto;">Carrinho vazinho</div>
        </div>
    @endif

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/xml2json.min.js"></script>
    <script type="text/javascript" >

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {

            } //end if.
            else {
                //CEP não Encontrado.
                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        }

        function pesquisacep(valor) {

            //Nova variável "cep" somente com dígitos.
            var cep = valor.replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {
                    //Calcula o frete
                        var x2js = new X2JS();
                        $.ajax({
                            url: `http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?&sCepOrigem=75083470&sCepDestino=${cep}&nVlPeso=1&nCdFormato=1&nVlComprimento=20&nVlAltura=20&nVlLargura=20&sCdMaoPropria=n&nVlValorDeclarado=0,&sCdAvisoRecebimento=n&nCdServico=04510&nVlDiametro=0&StrRetorno=xml&nIndicaCalculo=3p`,
                        dataType: "xml",
                            success:
                        function (data) {
                            // XML
                            var xmlText = data;
                            // Convert XML to JSON
                            var jsonData = x2js.xml2json(xmlText);
                            console.log(jsonData.Servicos.cServico);
                            $("#valorFrete").html(jsonData.Servicos.cServico.Valor);
                            $("#prazoFrete").html(jsonData.Servicos.cServico.PrazoEntrega);

                            //Convertendo o valor do frete para Float
                            var tCorreio = jsonData.Servicos.cServico.Valor;
                            tCorreio = tCorreio.replace(",", ".");
                            tComra = parseFloat(document.getElementById('totalCompra').value);
                            var tCorreio = parseFloat(tCorreio, 10);
                            document.getElementById('totalCompra').value = (tCorreio+tComra).toFixed(2);

                            $('.btnCheckout').removeClass("disabled");
                        }});
                    //Cria um elemento javascript.
                    var script = document.createElement('script');

                    //Sincroniza com o callback.
                    script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                    //Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);

                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        };
    </script>

@endsection
