<?php namespace credits\Components\Menu;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['Menus'] = $this->app->share(function ($app) {
            $menuBuilder = new MenuBuilder();
            return $menuBuilder;
        });

    }
}