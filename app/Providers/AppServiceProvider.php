<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \PagSeguro\Library::initialize();
        \PagSeguro\Library::cmsVersion()->setName("Nome")->setRelease("1.0.0");
        \PagSeguro\Library::moduleVersion()->setName("Nome")->setRelease("1.0.0");

//        $categories = \App\Category::all(['name', 'slug']);
//
////        view()->share('categories', $categories);
////        view()->composer('*', function ($view) use ($categories){
////            $view->with('categories', $categories);
////        });
//
//        view()->composer('layouts.front', 'App\Http\Views\CategoryViewComposer@compose');
    }

}
