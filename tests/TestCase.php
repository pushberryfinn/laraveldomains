<?php

namespace Pushberryfinn\LaravelDomains\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Pushberryfinn\LaravelDomains\LaravelDomainsServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            LaravelDomainsServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'LaravelDomains' => \Pushberryfinn\LaravelDomains\LaravelDomainsFacade::class,
        ];
    }
}
