<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notifications\UserNewOrder;
use App\UserOrder;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    private $order;
    public function __construct(UserOrder $order)
    {
        $this->order = $order;
    }

    public function index(){
        //Loja do usuario autenticado
        $orders = auth()->user()->store->orders()->orderBy('created_at', 'DESC')->paginate();

        return view('admin.orders.index', compact('orders'));
    }


    public function edit( $order)
    {

        $user = auth()->user();
        $user->notify(new UserNewOrder($user));

        $order = $this->order->findOrFail($order);
        $user = \App\User::find($order->user_id);

         $adress = explode(',',$order->sender_adress);

        return view('admin.orders.edit', compact( 'order', 'user', 'adress'));
    }


    public function update(Request $request, $id)
    {

        $data = $request->all();

        $order = \App\UserOrder::find($id);

//        dd($data);
        $order->update($data);

        flash('Pedido atualizado com Sucesso!')->success();
        return redirect()->route('admin.orders.my');
    }
}
