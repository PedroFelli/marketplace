<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $product;

    public function __construct(Product $product){
        $this->product = $product;
    }

    public function index()
    {
        $products = $this->product->limit(8)->orderBy('id', 'DESC')->get();

        return view('welcome', compact('products'));
    }

    public function single($slug){
        $product = $this->product->whereSlug($slug)->first();
        $sizes = \App\Size::all(['id', 'name']);
        $colors = \App\Color::all(['id', 'name']);

        if(!count($product->sizes)){
           $sizes = 0;
        }

        if(!count($product->colors)){
            $colors = 0;
        }

        return view('single', compact('product', 'sizes', 'colors'));
    }
}
