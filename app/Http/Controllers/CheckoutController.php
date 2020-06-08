<?php

namespace App\Http\Controllers;

use App\Http\Requests\SenderRequest;
use App\Mail\UserCodigoEnvioEmail;
use App\Mail\UserRegisteredEmail;
use App\Notifications\UserNewOrder;
use App\Notifications\UserReceiveNewPayment;
use App\Payment\CalculoFrete;
use App\Payment\PagSeguro\CreditCard;
use App\Payment\PagSeguro\Notification;
use App\Store;
use App\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;


class CheckoutController extends Controller
{

    public function step1()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!session()->has('cart'))
            return redirect()->route('step1');

        //        $this->makePagSeguroSession();
        //
        $cartItems = array_map(function ($line) {
            return $line['amount'] * $line['price'];
        }, session()->get('cart'));

        $cartItems = array_sum($cartItems);

        return view('checkout-step1', compact('cartItems'));
    }

    public function step2(SenderRequest $request)
    {
        $sender = $request->all();


        // dd($sender['cep']);
        //Calculando valor do frete
        $valorFrete = new CalculoFrete();
        $valorFrete = $valorFrete->calculoFrete($sender['cep']);

        $valorFrete;

        //  checando o endereço do sender
        if (session()->has('sender')) {
            session()->forget('sender');
            session()->put('sender', $sender);
        } else {
            session()->put('sender', $sender);
        }


        $this->makePagSeguroSession();

        $cartItems = array_map(function ($line) {
            return $line['amount'] * $line['price'];
        }, session()->get('cart'));

        $cartItems = array_sum($cartItems);

        return view('checkout-step2', compact('cartItems', 'valorFrete'));
    }



    public function proccess(Request $request)
    {
        try {
            $dataPost = $request->all();
            $user = auth()->user();
            $cartItems = session()->get('cart');
            $senderAddress  = session()->get('sender');
            $stores = array_unique(array_column($cartItems, 'store_id'));
            $reference = Uuid::uuid4();


            $creditCardPayment = new CreditCard($cartItems, $user, $dataPost, $senderAddress, $reference);
            $result = $creditCardPayment->doPayment();

            $userOder = [
                'reference' => $reference,
                'pagseguro_code' => $result->getCode(),
                'pagseguro_status' => $result->getStatus(),
                'items' => serialize($cartItems),
                'sender_adress' => implode(",", $senderAddress),

            ];

            $userOder = $user->orders()->create($userOder);

            $userOder->stores()->sync($stores);

            //Notificar Loja de novo pedido

            $user->notify(new UserNewOrder());
            $store = (new Store())->notifyStoreOwners($stores);

            session()->forget('cart');
            session()->forget('pagseguro_session_code');

            return response()->json([
                'data' => [
                    'status' => true,
                    'message' => 'Pedido criado com sucesso!',
                    'order' => $reference,
                ]
            ]);
        } catch (\Exception $e) {
            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar pedido!';
            return response()->json([
                'data' => [
                    'status' => false,
                    'message' => $message
                ]
            ], 401);
        }
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function notification()
    {
        try {

            $notification = new Notification();
            $notification = $notification->getTransaction();

            $reference = base64_decode($notification->getReference());

            // Atualiza o status do pagseguro
            $pagSeguroStatus = UserOrder::where('reference', $reference)->first()->update([
                //Atualizar o pedido do usuario
                'pagseguro_status' => $notification->getStatus()
            ]);

            if ($notification->getStatus() == 3) {
                // @TODO Notificar a loja da confirmação do pedido
                //Busca a referencia do pedido, busca a ordem com essa referencia
                $userOder = UserOrder::where('reference', $reference)->first();
                $storedId = DB::table('order_store')->where('order_id', $userOder->id)->first();
                $store = (new Store())->notifyStoreReceiveNewPayment([$storedId->store_id]);

                //  atualizar o status do pedido para separação
                $pedidoStatus = UserOrder::where('reference', $reference)->first()->update([
                    //Atualizar o pedido para em separação
                    'pedido_status' => 3
                ]);

                //  Notificar o usuario que o pedido foi pago
                $user = \App\User::find($userOder->user_id);
                $user->notify(new UserReceiveNewPayment());
            }

            return response()->json([], 204);
        } catch (\Exception $e) {
            $message = env('APP_DEBUG') ? $e->getMessage() : [];
            return response()->json(['error' => $message], 500);
        }
    }

    private function makePagSeguroSession()
    {

        if (!session()->has('pagseguro_session_code')) {
            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            session()->put('pagseguro_session_code', $sessionCode->getResult());
        }
    }
}
