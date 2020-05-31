@extends('layouts.front')

@section('stylesheets')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js">
@endsection

@section('content')
    <div class="container">
        <div class="size-350">
            <div class=" bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                <h4 class="mtext-105 cl2 txt-center p-b-30">
                    Dados do pagamento
                </h4>
                <form action="" method="post">
                    <div>
                        <h5>Dados do Cartão</h5>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Nome no cartão </label>
                                <input type="text" class="form-control" name="card_name">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Data de Nascimento </label>
                            <input type="text" class="form-control" name="card_birthdate" id="card_birthdate"
                                   placeholder="01/10/1979">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>CPF</label>
                            <input type="text" class="form-control "name="card_cpf"
                                   placeholder="16263476540">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Telefone</label>
                            <input type="tel" class="form-control "name="card_telefone" id="card_telefone"

                                   required >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Número do cartão <span class="brand"></span></label>
                            <input type="text" class="form-control "name="card_number">
                            <input type="hidden" name="card_brand">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mês de experição</label>
                            <input type="text" class="form-control "name="card_month">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Ano experição</label>
                            <input type="text" class="form-control "name="card_year">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Codigo de Segurança</label>
                            <input type="text" class="form-control"
                                   id="codigo_segurança"
                                   name="card_cvv">
                        </div>

                        <div class="col-md-12 installments form-group"></div>

                    </div>
                    </div>
                    <div>
                        <h5>Endereço do faturamento</h5>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>CEP</label>
                                <input name="cep" class="form-control" type="text" id="cep" value="" size="10" maxlength="9"
                                       onblur="pesquisacep(this.value);"  placeholder="00000-000" />
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Rua </label>
                                <input type="text" class="form-control" value="" name="rua" id="rua" >
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Numero:</label>
                                <input type="text" class="form-control" value="" name="numero" id="numero">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Bairro</label>
                                <input type="text" class="form-control" value="" id="bairro" name="bairro">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Cidade</label>
                                <input type="text" class="form-control" value="" id="cidade" name="cidade"
                                       placeholder="São Paulo"
                                >
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Estado</label>
                                <input type="text" class="form-control" value="" id="uf" name="uf"
                                       placeholder="SP">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Complemento</label>
                                <input type="text" class="form-control" id="complemento" name="complemento"
                                       placeholder="Ex: apto. 114"
                                >
                            </div>

                        </div>

                    </div>
                    <button
                        class="btn btn-primary processCheckout" id="btn-pag">
                        Finalizar Compra
                    </button>
                    <div class="spinner-border text-primary d-none" id="spinner-pag" role="status" >
                        <span class="sr-only">Loading...</span>
                    </div>
                </form>

        </div>
    </div>
@endsection

@section('scripts')
        <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



    <script>
        const sessionId = '{{session()->get('pagseguro_session_code')}}';
        const urlThanks = '{{route('checkout.thanks')}}';
        const urlProccess = '{{route("checkout.proccess")}}';
        const amountTransaction = '{{$cartItems + $valorFrete}}';
        const csrf = '{{csrf_token()}}';

        PagSeguroDirectPayment.setSessionId(sessionId);

    </script>
    <script src="{{asset('js/pagseguro_functions.js')}}"></script>
    <script src="{{asset('js/pagseguro_events.js')}}"></script>


        <script>
            let imBirthDate = new Inputmask('99/99/9999');
            imBirthDate.mask(document.getElementById('card_birthdate'));

            let imMobilePhone = new Inputmask('99-999999999');
            imMobilePhone.mask(document.getElementById('card_telefone'));
        </script>
            <script type="text/javascript" >

                function limpa_formulário_cep() {
                    //Limpa valores do formulário de cep.
                    document.getElementById('rua').value=("");
                    document.getElementById('bairro').value=("");
                    document.getElementById('cidade').value=("");
                    document.getElementById('uf').value=("");
                    document.getElementById('ibge').value=("");
                }

                function meu_callback(conteudo) {
                    if (!("erro" in conteudo)) {
                        //Atualiza os campos com os valores.
                        document.getElementById('rua').value=(conteudo.logradouro);
                        document.getElementById('bairro').value=(conteudo.bairro);
                        document.getElementById('cidade').value=(conteudo.localidade);
                        document.getElementById('uf').value=(conteudo.uf);
                        document.getElementById('ibge').value=(conteudo.ibge);
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

                            //Preenche os campos com "..." enquanto consulta webservice.
                            document.getElementById('rua').value="...";
                            document.getElementById('bairro').value="...";
                            document.getElementById('cidade').value="...";
                            document.getElementById('uf').value="...";


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


