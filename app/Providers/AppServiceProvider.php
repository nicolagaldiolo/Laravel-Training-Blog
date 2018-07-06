<?php

namespace App\Providers;

use App\Post;
use App\Category;
use App\Tag;
use App\Observers\PostObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Post::observe(PostObserver::class); // implememento un observe che a seconda di alcune operazioni che vengono
        // effettuate dal modello (cancellazione, update, ecc) chiamo i relativi metodi dell'observe

        \View::composer(['layouts.app'], function($view){
            $categories = Category::all();
            $tags = Tag::all();
            return $view->with('categories', $categories)->with('tags', $tags);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
