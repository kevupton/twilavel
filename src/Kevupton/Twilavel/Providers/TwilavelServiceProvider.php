<?php namespace Kevupton\Twilavel\Providers;

use Kevupton\LaravelPackageServiceProvider\ServiceProvider;
use Kevupton\Twilavel\Facades\Twilio as TwilioFacade;
use Kevupton\Twilavel\Twilio;

class TwilavelServiceProvider extends ServiceProvider
{
    const SINGLETON = 'twilavel';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot ()
    {
        $this->registerConfig('/../../../config/twilio.php', 'twilio.php');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register ()
    {
        $this->app->singleton(self::SINGLETON, function ($app) {
            return new Twilio();
        });

        $this->registerConfig(TwilioFacade::class, 'Twilio');

        $this->mergeConfigFrom(
            __DIR__ . '/../../../config/twilio.php', 'twilio'
        );
    }
}