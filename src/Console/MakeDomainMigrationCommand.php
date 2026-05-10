<?php

namespace Pushberryfinn\LaravelDomains\Console;

use Illuminate\Console\Command;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Support\Composer;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeDomainMigrationCommand extends Command
{
    protected $name = 'domain:make-migration';
    protected $description = 'Create a new migration file inside a domain';

    public function __construct(
        protected MigrationCreator $creator,
        protected Composer $composer
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        $domain = $this->option('domain');

        if (!$domain) {
            $this->components->error('The --domain option is required.');
            return;
        }

        $name   = Str::snake(trim($this->argument('name')));
        $table  = $this->option('table');
        $create = $this->option('create') ?: false;

        if (!$table && is_string($create)) {
            $table  = $create;
            $create = true;
        }

        if (!$table) {
            [$table, $create] = $this->guessTableName($name);
        }

        $path = app_path("Domains/{$domain}/database/migrations");

        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }

        $file = $this->creator->create($name, $path, $table, $create);

        $this->components->info(sprintf('Migration [%s] created successfully.', $file));
    }

    protected function guessTableName(string $name): array
    {
        if (preg_match('/^create_(\w+)_table$/', $name, $matches)) {
            return [$matches[1], true];
        }

        foreach (['_to_', '_from_', '_in_'] as $token) {
            if (str_contains($name, $token)) {
                return [Str::after($name, $token), false];
            }
        }

        return [null, false];
    }

    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the migration'],
        ];
    }

    protected function getOptions(): array
    {
        return [
            ['create', null, InputOption::VALUE_OPTIONAL, 'The table to be created'],
            ['table',  null, InputOption::VALUE_OPTIONAL, 'The table to migrate'],
            ['domain', null, InputOption::VALUE_REQUIRED, 'The domain name'],
        ];
    }
}
