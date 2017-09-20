<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 20/09/2017
 * Time: 10:40 AM
 */

namespace Kevupton\Twilavel\Facades;

use Illuminate\Support\Facades\Facade;
use Kevupton\Twilavel\Providers\LaravelTwilioServiceProvider;

class Twilio extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return LaravelTwilioServiceProvider::SINGLETON; }
}