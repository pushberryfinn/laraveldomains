<?php

namespace Pushberryfinn\LaravelDomains\Console;

use Illuminate\Database\Console\Migrations\MigrateMakeCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class MakeDomainMigrationCommand extends MigrateMakeCommand
{
    protected $name = 'domain:make-migration';

    protected function getMigrationPath()
    {
        $domain = $this->input->getOption('domain');
        return app_path("Domains/{$domain}/database/migrations");
    }

    protected function getOptions()
    {
        return array_merge(parent::getOptions(), [
            ['domain', null, InputOption::VALUE_REQUIRED, 'The domain name'],
        ]);
    }
}
