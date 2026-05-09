<?php

namespace Pushberryfinn\LaravelDomains\Console;

use Illuminate\Foundation\Console\ConsoleMakeCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class MakeDomainConsoleCommand extends ConsoleMakeCommand
{
    protected $name = 'domain:make-command';

    protected $description = 'Create a new Artisan command inside a domain';

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\\Domains\\' . $this->option('domain') . '\\Console\\Commands';
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        return app_path(str_replace('\\', '/', $name) . '.php');
    }

    protected function getOptions()
    {
        return array_merge(parent::getOptions(), [
            ['domain', null, InputOption::VALUE_REQUIRED, 'The domain name'],
        ]);
    }
}
