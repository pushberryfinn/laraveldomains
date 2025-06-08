<?php

namespace Pushberryfinn\LaravelDomains\Console;

use Illuminate\Routing\Console\ControllerMakeCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class MakeDomainControllerCommand extends ControllerMakeCommand
{
    protected $name = 'domain:make-controller';

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\\Domains\\' . $this->option('domain') . '\\Http\\Controllers';
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
