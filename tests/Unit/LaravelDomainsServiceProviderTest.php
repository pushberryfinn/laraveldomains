<?php

namespace Pushberryfinn\LaravelDomains\Tests\Unit;

use Pushberryfinn\LaravelDomains\LaravelDomains;
use Pushberryfinn\LaravelDomains\Tests\TestCase;

class LaravelDomainsServiceProviderTest extends TestCase
{
    public function test_it_binds_laravel_domains_to_container(): void
    {
        $this->assertInstanceOf(LaravelDomains::class, $this->app->make('laravel-domains'));
    }

    public function test_it_merges_config(): void
    {
        $this->assertNotNull(config('laravel-domains'));
        $this->assertSame('Domains', config('laravel-domains.path'));
        $this->assertSame('App\\Domains', config('laravel-domains.namespace'));
    }

    public function test_facade_resolves_correctly(): void
    {
        $this->assertInstanceOf(LaravelDomains::class, \LaravelDomains::getFacadeRoot());
    }

    public function test_domains_returns_array(): void
    {
        $result = $this->app->make('laravel-domains')->domains();

        $this->assertIsArray($result);
    }
}
