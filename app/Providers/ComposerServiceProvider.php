<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
         // 使用基于类的composers...
        view()->composer(
            ['microblogs._fastCreateForm'], 'App\Http\ViewComposers\ProfileComposer'
        );

    }

    /**s
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
