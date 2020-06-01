<?php

namespace App;


use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasSlug;

    protected $fillable = ['name', 'description', 'body', 'price','slug'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function photos(){
        return $this->hasMany(ProductPhoto::class);
    }

    public function sizes(){
        return $this->belongsToMany(Size::class);
    }

    public function colors(){
        return $this->belongsToMany(Color::class);
    }
}
