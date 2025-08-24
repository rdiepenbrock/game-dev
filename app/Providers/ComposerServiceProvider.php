<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container
     *
     * @return void
     */
    public function boot()
    {
    	view::composer('*', 'App\Http\ViewComposers\isAdminComposer');
    	view::composer('*', 'App\Http\ViewComposers\MobileComposer');
        view::composer(
            ['profile/*', '/dashboard', 'game/*'],
            'App\Http\ViewComposers\UsernameComposer'
        );

        view::composer('partials.navigation', 'App\Http\ViewComposers\UserComposer');
    }

    /**
     * Register the service provider
     *
     * @return void
     */
    public function register()
    {

    }
}
