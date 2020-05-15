<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function (){

//    Route::prefix('stores')->name('stores.')->group(function (){
//        Route::get('/', 'StoreController@index')->name('index');
//        Route::get('/create', 'StoreController@create')->name('create');
//        Route::post('/store', 'StoreController@store')->name('store');
//        Route::get('/{store}/edit', 'StoreController@edit')->name('edit');
//        Route::post('/update/{store}', 'StoreController@update')->name('update');
//        Route::get('/destroy/{store}', 'StoreController@destroy')->name('destroy');
// });

    Route::resource('stores', 'StoreController');
    Route::resource('products', 'ProductController');
});



Route::get('/model', function () {
    //$products = \App\Product::all();
//    $user = new \App\User();
//    $user->name = 'Usuario teste';
//    $user->email = 'email@teste.com';
//    $user->password = bcrypt('1234567');
//
//    $user->save();
//    $user = \App\User::find(4);
//
//    return $user->store;
//  $loja = \App\Store::find(1);
//  $loja->products()->products()->where('id', 9)->get();
//  return $loja;

    //Criar uma loja para um usuario
//    $user = \App\User::find(10);
//    $store = $user->store()->create([
//        'name' => 'Loja teste',
//        'description' => 'Loja teste de produtos de informatica',
//        'mobile_phone' => 'xx-xxxxx-xxxx',
//        'phone' => 'xx-xxxx-xxx',
//        'slug'=> 'loja-teste'
//    ]);
//
//    dd($store);
    //criar um produto para uma loja
//    $store = \App\Store::find(41);
//    $product = $store->products()->create([
//        'name' => 'Notebook dell',
//        'description' => 'CORE I5 8G 500GB',
//        'body' => 'Qualquer coisa',
//        'price'=> 2999.9,
//        'slug' => 'notebook-dell',
//    ]);
//
//    dd($product);

//    criar uma categoria
//    \App\Category::create([
//        'name' => 'Games',
//        'slug' => 'games',
//    ]);
//
//    \App\Category::create([
//        'name' => 'Notebooks',
//        'slug' => 'notebooks',
//    ]);
//
// return \App\Category::all();

    //adicionar um produto para uma categoria ou vice-versa
//    $product = \App\Product::find(41);
//
//    dd($product->categories()->sync([1,2]));
//
//    return \App\User::all();
});
