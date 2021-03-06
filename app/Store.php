<?php

namespace App;

use App\Notifications\StoreReceiveNewPayment;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\StoreReceiveNewOrder;

class Store extends Model
{
    use HasSlug;
    protected $fillable = ['name', 'description', 'phone', 'mobile_phone', 'slug', 'logo'];

    public function user(){
        return  $this->belongsTo(User::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function orders(){
        return  $this->belongsToMany(UserOrder::class, 'order_store', null, 'order_id');
    }

    public function notifyStoreOwners(array $storeId = []){
        $stores = $this->whereIn('id', $storeId)->get();

        return $stores->map(function ($store){
            return $store->user;
        })->each->notify(new StoreReceiveNewOrder);

    }

    public function notifyStoreReceiveNewPayment(array $storeId = []){
        $stores = $this->whereIn('id', $storeId)->get();

        return $stores->map(function ($store){
            return $store->user;
        })->each->notify(new StoreReceiveNewPayment());
    }


}
