<?php


namespace App\ViewComposers;

use App\Input\Admin\Configurations;
use App\Providers\RouteServiceProvider;
use Illuminate\View\View;

class RouteComposer
{
    public function compose(View $view)
    {
        $view->with('route', RouteServiceProvider::HOME);
    }
}
