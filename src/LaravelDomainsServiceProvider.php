<?php

namespace Pushberryfinn\LaravelDomains;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class LaravelDomainsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'laravel-domains');

        $this->app->singleton('laravel-domains', fn () => new LaravelDomains());
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('laravel-domains.php'),
            ], 'laravel-domains-config');

            $this->registerConsoleCommands();
        }
    }

    protected function registerConsoleCommands()
    {
        $commandNamespace = 'Pushberryfinn\\LaravelDomains\\Console\\';
        $commandPath = __DIR__ . '/Console';

        if (!is_dir($commandPath)) {
            return;
        }

        $commands = [];

        foreach (File::files($commandPath) as $file) {
            $class = $commandNamespace . Str::replaceLast('.php', '', $file->getFilename());

            if (class_exists($class) && is_subclass_of($class, \Illuminate\Console\Command::class)) {
                $commands[] = $class;
            }
        }

        if (!empty($commands)) {
            $this->commands($commands);
        }
    }
}
