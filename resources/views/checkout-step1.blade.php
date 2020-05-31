@extends('layouts.front')

@section('stylesheets')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js">
@endsection

@section('content')
    <div class="container">
        <div class="size-350">
            <div class=" bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                <p class="mtext-105 cl2 txt-center p-b-30">
                    Finalizando pagamento
                </p>
                <div class="progress" style=" margin-bottom: 15px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%"></div>
                </div>
                <hr>
                <form action="{{route('checkout.step2')}}" method="post">
                    @csrf
                    <div> <h5>Endereço para entrega</h5>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>CEP</label>
                                <input type="text" name="cep" class="form-control @error('cep') is-invalid @enderror "  id="cep" value="{{old('cep')}}" size="10" maxlength="9"
                                       onblur="pesquisacep(this.value);"  placeholder="00000-000" />

                                @error('cep')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group">
                                <label>Rua </label>
                                <input type="text"  name="rua" class="form-control @error('rua') is-invalid @enderror " value="{{old('rua')}}"  id="rua" >
                                @error('rua')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Numero:</label>
                                <input type="text" class="form-control @error('numero') is-invalid @enderror " value="{{old('numero')}}"  name="numero" id="numero">
                                @error('numero')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Bairro</label>
                                <input type="text" class="form-control @error('bairro') is-invalid @enderror " value="{{old('bairro')}}"  id="bairro" name="bairro">
                                @error('bairro')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Cidade</label>
                                <input type="text" class="form-control @error('cidade') is-invalid @enderror" value="{{old('cidade')}}"  id="cidade" name="cidade"
                                       placeholder="São Paulo"
                                >
                                @error('cidade')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Estado</label>
                                <input type="text" class="form-control @error('uf') is-invalid @enderror" value="{{old('uf')}}"  id="uf" name="uf"
                                       placeholder="SP">
                                @error('uf')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Complemento</label>
                                <input type="text" class="form-control" id="complemento" name="complemento" value="{{old('complemento')}}"
                                       placeholder="Ex: apto. 114"
                                >
                            </div>
                        </div>

                    </div>
                    <button
                        class="btn btn-primary processCheckout" id="btn-pag">
                        Finalizar Compra
                    </button>
                </form>

        </div>
    </div>
@endsection

@section('scripts')
        <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
            <script type="text/javascript" src="{{asset('js/xml2json.min.js')}}"></script>


            <script type="text/javascript" >

                function limpa_formulário_cep() {
                    //Limpa valores do formulário de cep.
                    document.getElementById('rua').value=("");
                    document.getElementById('bairro').value=("");
                    document.getElementById('cidade').value=("");
                    document.getElementById('uf').value=("");

                }

                function meu_callback(conteudo) {
                    if (!("erro" in conteudo)) {
                        //Atualiza os campos com os valores.
                        document.getElementById('rua').value=(conteudo.logradouro);
                        document.getElementById('bairro').value=(conteudo.bairro);
                        document.getElementById('cidade').value=(conteudo.localidade);
                        document.getElementById('uf').value=(conteudo.uf);

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


