<?php


namespace App\Providers;

use App\ViewComposers\AllLeaguesComposer;
use App\ViewComposers\BannersComposer;
use App\ViewComposers\RouteComposer;
use App\ViewComposers\StreamComposer;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['main', 'tournament', 'player', 'team'], BannersComposer::class);
        view()->composer(['player', 'team'], AllLeaguesComposer::class);
        view()->composer('admin.*', RouteComposer::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
