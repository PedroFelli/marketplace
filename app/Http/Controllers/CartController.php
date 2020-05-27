<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardAddRequest;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class CartController extends Controller
{
    public function index(){
        $cart = session()->has('cart') ? session()->get('cart') : [];

        return view('cart', compact('cart'));
    }

    public function add(CardAddRequest $request){
        $productData = $request->get('product');

        $product = \App\Product::whereSlug($productData['slug']);

        if(!$product->count() || $productData['amount'] <= 0)
            return redirect()->route('home');

        $product = array_merge( $productData, $product -> first([ 'id', 'name', 'price', 'store_id'])->toArray());


        //verificar se existe sessão para os produtos
        if(session()->has('cart')){

            $products = session()->get('cart');
            $productsSlugs = array_column($products, 'slug');

            if(in_array($product['slug'], $productsSlugs)){
                //existindo add esse produto duplicado sessao existente
                $products = $this->productIncrement($product['slug'], $product['amount'], $products);
                session()->put('cart', $products);
            } else {
                //existindo add esse produto na sessao existente
                session()->push('cart', $product);
            }

        } else {

            //nao existindo a sessao criar nova
            $products[] = $product;
            session()->put('cart', $products);
        }

        flash('Produto adicionado no carrinho')->success();
        return redirect()->route('product.single', ['slug'=> $product['slug']]);

    }

    public function remove($slug){

        if(!session()->has('cart'))
            return redirect()->route('cart.index');

        $products = session()->get('cart');

        $products = array_filter($products, function($line) use($slug){
            return $line['slug'] != $slug;
        });

        session()->put('cart', $products);
        return redirect()->route('cart.index');
    }

    public function cancel(){
        session()->forget('cart');

        flash('Desistencia da compra realizada com sucesso')->success();
        return redirect()->route('cart.index');
    }

    private function productIncrement($slug, $amount, $products){
        $products = array_map(function ($line) use($slug, $amount){
            if($slug == $line['slug']){
                $line['amount'] += $amount;
            }
            return $line;
        }, $products);

        return $products;
    }

}
