<?php

namespace Pushberryfinn\LaravelDomains\Console;

use Illuminate\Foundation\Console\ModelMakeCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class MakeDomainModelCommand extends ModelMakeCommand
{
    protected $name = 'domain:make-model';

    protected function getDefaultNamespace($rootNamespace)
    {
        $domain = $this->option('domain');
        return "App\\Domains\\{$domain}\\Models";
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        return app_path(str_replace('\\', '/', $name) . '.php');
    }

    protected function getOptions()
    {
        return array_merge(parent::getOptions(), [
            ['domain', null, InputOption::VALUE_REQUIRED, 'The domain name to use'],
        ]);
    }
}
