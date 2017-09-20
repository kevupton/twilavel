<?php namespace Kevupton\Twilavel\Providers;

use Illuminate\Support\ServiceProvider;
use Kevupton\Twilavel\Twilio;

class TwilavelServiceProvider extends ServiceProvider {

    const SINGLETON = 'laravel-twilio';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/../../../config/twilio.php' => config_path('twilio.php')]);

        $this->app->singleton(self::SINGLETON, function ($app) {
            return new Twilio();
        });

        class_alias(\Kevupton\Twilavel\Facades\Twilio::class, 'Twilio');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../../config/twilio.php', 'twilio'
        );
    }

    /**
     * Checks if the application is a lumen instance
     * @return bool
     */
    public function is_lumen () {
        return is_a($this->app, 'Laravel\Lumen\Application');
    }

    /**
     * Checks if the application is laravel
     * @return bool
     */
    public function is_laravel () {
        return !$this->is_lumen();
    }
}