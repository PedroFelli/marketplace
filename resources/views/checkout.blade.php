@extends('layouts.front')

@section('stylesheets')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js">
@endsection

@section('content')
    <div class="container">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <h2>Dados para Pagamento</h2>
                    <hr>
                </div>
            </div>
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Nome no cartão
                        <input type="text" class="form-control "name="card_name">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Número do cartão <span class="brand"></span></label>
                        <input type="text" class="form-control "name="card_number">
                        <input type="hidden" name="card_brand">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>Mês de experição</label>
                        <input type="text" class="form-control "name="card_month">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Ano experição</label>
                        <input type="text" class="form-control "name="card_year">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 form-group">
                        <label>Codigo de Segurança</label>
                        <input type="text" class="form-control "name="card_cvv">
                    </div>
                    <div class="col-md-12 installments form-group"></div>
                </div>

                <button class="btn btn-success btn-md processCheckout">Finalizar Compra</button>
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
        const amountTransaction = '{{$cartItems}}';
        const csrf = '{{csrf_token()}}';

        PagSeguroDirectPayment.setSessionId(sessionId);

    </script>
    <script src="{{asset('js/pagseguro_functions.js')}}"></script>
    <script src="{{asset('js/pagseguro_events.js')}}"></script>

@endsection
