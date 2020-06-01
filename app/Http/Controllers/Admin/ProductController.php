<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ProductSize;
use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\ProductsRequest;
use App\Traits\UploadTrait;


class ProductController extends Controller
{
    use UploadTrait;
    private $product;

    public function __construct(Product $product){
        $this->product = $product;
    }

    public function index()
    {
        $user = auth()->user();

        if(!$user->store()->exists()){
            flash('É preciso criar uma loja para cadastrar produtos!')->warning();
            return redirect()->route('admin.stores.index');
        }

        $products = \App\Product::all();


        return view('admin.products.index', compact('products'));
    }


    public function create()
    {
        $categories = \App\Category::all(['id', 'name']);
        $sizes = \App\Size::all(['id', 'name']);
        $colors = \App\Color::all(['id', 'name']);

        return view('admin.products.create', compact('categories', 'sizes', 'colors'));
    }


    public function store(ProductsRequest $request)
    {

        $data = $request->all();
        $categories = $request->get('categories', null);
        $sizes = $request->get('sizes', null);
        $colors = $request->get('colors', null);

        $data['price'] = formatPriceToDataBase($data['price']);

        $store = auth()->user()->store;
        $product = $store->products()->create($data);

        $product->categories()->sync($categories);
        $product->sizes()->sync($sizes);
        $product->colors()->sync($colors);

        if($request->hasFile('photos')){
            $images = $this->imageUpload($request->file('photos'), 'image');

            //insersão destes images/referencias;
            $product->photos()->createMany($images);

        }

        flash('Produto criado com Sucesso!')->success();
        return redirect()->route('admin.products.index');
    }


    public function show($id)
    {
        return $id;
    }


    public function edit($product)
    {
        $categories = \App\Category::all(['id', 'name']);
        $sizes = \App\Size::all(['id', 'name']);
        $colors = \App\Color::all(['id', 'name']);
        $product = $this->product->findOrFail($product);

        return view('admin.products.edit', compact('product', 'categories', 'sizes', 'colors'));
    }


    public function update(ProductsRequest $request, $product)
    {
        $data = $request->all();
        $categories = $request->get('categories', null);
        $sizes = $request->get('sizes', null);
        $colors = $request->get('colors', null);

        $product = $this->product->find($product);
        $product->update($data);

        //TODO limpar categorias
        if (!is_null($categories)){
        $product->categories()->sync($categories);
        }

        if (!is_null($sizes)){
            $product->sizes()->sync($sizes);
        }else {

            $productSizes = ProductSize::where('product_id', $product->id)->get(['product_id']);

            foreach ($productSizes as $productSize){

                ProductSize::where('product_id', $productSize->product_id)->delete();
            }
        }
       if (!is_null($colors)){
           $product->colors()->sync($colors);
        }

        if($request->hasFile('photos')){
            $images = $this->imageUpload($request->file('photos'), 'image');

            //insersão destes images/referencias;
            $product->photos()->createMany($images);

        }

        flash('Produto atualizado com Sucesso!')->success();
        return redirect()->route('admin.products.index');
    }


    public function destroy($product)
    {
        $product = $this->product->find($product);
        $product->delete($product);

        flash('Produto removido com Sucesso!')->success();
        return redirect()->route('admin.products.index');
    }


}
