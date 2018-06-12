<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    //AppServiceProvider 是框架的核心，在 Laravel 启动时，会最先加载该文件
    public function boot()
	{
		\App\Models\User::observe(\App\Observers\UserObserver::class);
		\App\Models\Microblog::observe(\App\Observers\MicroblogObserver::class);
                     \App\Models\Comment::observe(\App\Observers\CommentObserver::class);
                     \App\Models\Category::observe(\App\Observers\CategoryObserver::class);
        //
         \Carbon\Carbon::setLocale('zh');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
         if (app()->isLocal()) {
            $this->app->register(\VIACreative\SudoSu\ServiceProvider::class);
        }
    }
}
