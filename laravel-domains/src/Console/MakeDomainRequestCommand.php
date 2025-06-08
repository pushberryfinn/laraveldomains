<?php

namespace Pushberryfinn\LaravelDomains\Console;

use Illuminate\Foundation\Console\RequestMakeCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class MakeDomainRequestCommand extends RequestMakeCommand
{
    protected $name = 'domain:make-request';

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\\Domains\\' . $this->option('domain') . '\\Http\\Requests';
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
