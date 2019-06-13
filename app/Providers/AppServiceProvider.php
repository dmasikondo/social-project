<?php

namespace Social\Providers;

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
        view()->composer('pages.template.partials.avatar', function($view){
            $view->with('image',\Auth::user()->images()->where('isprofile', true)->latest()->limit(1)->get());
        });
    }
}
