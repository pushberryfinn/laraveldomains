<?php

namespace Pushberryfinn\LaravelDomains;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Pushberryfinn\LaravelDomains\LaravelDomains
 *
 * @method static array domains()
 */
class LaravelDomainsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-domains';
    }
}
