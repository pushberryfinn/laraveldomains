<?php

namespace Pushberryfinn\LaravelDomains;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Pushberryfinn\LaravelDomains\Skeleton\SkeletonClass
 */
class LaravelDomainsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-domains';
    }
}
