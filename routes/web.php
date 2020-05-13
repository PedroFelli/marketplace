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


Route::get('/model', function () {
    //$products = \App\Product::all();

//    $user = new \App\User();


//    $user->name = 'Usuario teste';
//    $user->email = 'email@teste.com';
//    $user->password = bcrypt('1234567');
//
//    $user->save();

    return \App\User::all();
});
