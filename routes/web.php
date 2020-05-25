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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{slug}', 'HomeController@single')->name('product.single');
Route::get('/category/{slug}', 'CategoryController@index')->name('category.single');
Route::get('/store/', 'StoreController@index')->name('store.index');
//Route::get('/store/{slug}', 'StoreController@index')->name('store.single');


Route::prefix('cart')->name('cart.')->group(function (){
    Route::get('/', 'CartController@index')->name('index');
    Route::post('add', 'CartController@add')->name('add');
    Route::get('remove/{slug}', 'CartController@remove')->name('remove');
    Route::get('cancel', 'CartController@cancel')->name('cancel');
});

Route::prefix('checkout')->name('checkout.')->group(function (){
    Route::get('/', 'CheckoutController@index')->name('index');
    Route::post('/proccess', 'CheckoutController@proccess')->name('proccess');
    Route::get('/thanks','CheckoutController@thanks')->name('thanks');

    Route::post('/notification','CheckoutController@notification')->name('notification');

});

Route::get('/my-orders', 'UserOrderController@index')->name('user.orders')->middleware('auth');

Route::group(['middleware' => ['auth', 'access.control.store.admin']], function (){
    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function (){
        Route::get('/', 'DashboardController@index')->name('index');
        Route::resource('stores', 'StoreController');
        Route::resource('products', 'ProductController');
        Route::resource('categories', 'CategoryController');

        Route::post('photos/remove/', 'ProductPhotoController@removePhoto')->name('photo.remove');

        Route::get('orders/my', 'OrdersController@index')->name('orders.my');
        Route::get('orders/{order}/edit', 'OrdersController@edit')->name('orders.edit');

        Route::get('notifications', 'NotificationController@notifications')->name('notifications.index');
        Route::get('notifications/read-all', 'NotificationController@readAll')->name('notifications.read.all');
        Route::get('notifications/read/{notification}', 'NotificationController@read')->name('notifications.read');
    });
});

Auth::routes();


Route::get('not', function(){

    $user = \App\User::find(41);
//    $user->notify(new \App\Notifications\StoreReceiveNewOrder());

//    $notification = $user->unreadNotifications->first();
//    $notification->markAsRead();

//        $stores= [43, 41, 30];
//        $store = \App\Store::whereIn('id', $stores)->get();
//
//        return $store->map(function ($store){
//            return $store->user;
//        });
//
//    return $store;
});

Route::get('/home', 'HomeController@index')->name('home');
