@extends('layouts.front')

@section('stylesheets')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js">
@endsection

@section('content')
    <div class="container">
        <div class="flex-w flex-tr">


            <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">

                <form action="" method="post">
                    <h4 class="mtext-105 cl2 txt-center p-b-30">
                        Dados do pagamento
                    </h4>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Nome no cartão </label>
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
                        <div class="col-md-6 form-group">
                            <label>Mês de experição</label>
                            <input type="text" class="form-control "name="card_month">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Ano experição</label>
                            <input type="text" class="form-control "name="card_year">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Codigo de Segurança</label>
                            <input type="text" class="form-control "name="card_cvv">
                        </div>
                        <div class="col-md-12 installments form-group"></div>
                    </div>
                    <button
                            class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10 processCheckout">
                        Finalizar Compra
                    </button>



                    <br>

                </form>
            </div>

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
    <script>
        $('.btn').on('click', function() {
            var $this = $(this);
            $this.button('loading');
            setTimeout(function() {
                $this.button('reset');
            }, 8000);
        });
    </script>
@endsection


