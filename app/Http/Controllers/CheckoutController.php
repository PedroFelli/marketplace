<?php

namespace App\Http\Controllers;

use App\Payment\PagSeguro\CreditCard;
use App\Payment\PagSeguro\Notification;
use App\Store;
use App\UserOrder;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;


class CheckoutController extends Controller
{
    public function index(){

        if(!auth()->check()){
            return redirect()->route('login');
        }

        if(!session()->has('cart'))
            return redirect()->route('home');

        $this->makePagSeguroSession();

        $cartItems = array_map(function ($line){
            return $line['amount']* $line['price'];
        }, session()->get('cart'));

        $cartItems = array_sum($cartItems);

        return view('checkout', compact('cartItems'));
    }

    public function proccess(Request $request){
        try {
            $dataPost = $request->all();
            $user = auth()->user();
            $cartItems = session()->get('cart');
            $stores = array_unique(array_column($cartItems, 'store_id'));
//            $reference = Uuid::uuid4();
            $reference = 'XPTO';

            $creditCardPayment = new CreditCard($cartItems, $user, $dataPost, $reference);
            $result = $creditCardPayment->doPayment();

            $userOder = [
                'reference' => $reference,
                'pagseguro_code' => $result->getCode(),
                'pagseguro_status' => $result->getStatus(),
                'items' => serialize($cartItems),
                'store_id' => 45,  #ignoreline
            ];

            $userOder = $user->orders()->create($userOder);

            $userOder->stores()->sync($stores);

            //Notificar Loja de novo pedido

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
        } catch (\Exception $e){
            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar pedido!';
            return response()->json([
                'data' => [
                    'status' => false,
                    'message' => $message
                ]
            ], 401);
        }
    }

    public function thanks(){
        return view('thanks');
    }

    public function notification(){

            $notification = new Notification();
            $notification = $notification->getTransaction();

            //Atualizar o pedido do usuario
//            $userOder = UserOrder::whereReference($notification->getReference());
            $userOder = UserOrder::where('reference', $notification->getReference())->first()->update(['pagseguro_status' => 3]);

            //@TODO  está alteerando o status do pagseguro no banco, verificar o reesto
            dd($userOder);
            $userOder->updade([
                '' => '3'
            ]);



            //Comentario sobre o pedido pago
            if($notification->getStatus() == 3){
                //Liberar o pedido do usuario, atualizar o status do pedido para separação
                //Notificar o usuario que o pedido foi pago
                //Notificar a loja da confirmação do pedido
            }

            return response()->json([], 204);
//        } catch (\Exception $e){
//            return response()->json([$e->getMessage()], 500);
//        }
    }

    private function makePagSeguroSession(){

        if(!session()->has('pagseguro_session_code')){
             $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            session()->put('pagseguro_session_code', $sessionCode->getResult());
        }
    }
}
