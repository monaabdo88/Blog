<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Post;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $settings = Setting::checkSettings();
        $categories = Category::with('children')->where('parent_id' , 0)->orWhere('parent_id' , null)->orWhere('status',1)->get();
        $lastFivePosts = Post::with('category','user')->orderBy('id')->limit(5)->get();
        View()->share([
            'setting'=>$settings,
            'categories'=>$categories,
            'lastFivePosts'=>$lastFivePosts,
        ]);
        
    }
}
