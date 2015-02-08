<?php
namespace credits\Components\ACL;
use Illuminate\Support\ServiceProvider;

class ACLServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['ACL'] = $this->app->share(function ($app) {
            $ACLBuilder = new ACLBuilder();
            return $ACLBuilder;
        });

    }
}