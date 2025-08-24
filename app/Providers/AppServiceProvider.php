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
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    	$this->app->bind(
			'App\Repositories\GameRepositoryInterface',
			'App\Repositories\GameRepository'
		);
    	
    	$this->app->bind(
			'App\Repositories\RoleRepositoryInterface',
			'App\Repositories\RoleRepository'
		);
    	
    	$this->app->bind(
			'App\Repositories\UserRepositoryInterface',
			'App\Repositories\UserRepository'
		);
    }
}
