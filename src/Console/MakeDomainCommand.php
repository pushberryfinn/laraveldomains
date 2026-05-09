<?php

namespace Pushberryfinn\LaravelDomains\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeDomainCommand extends Command
{
    protected $signature = 'domain:make {name}';
    protected $description = 'Create a new domain/module inside app/Domains';

    protected string $stubPath;

    public function __construct()
    {
        parent::__construct();
        $this->stubPath = __DIR__ . '/../stubs';
    }

    public function handle()
    {
        $domainName = ucfirst($this->argument('name'));
        $appPath = app_path();
        $domainsPath = $appPath . '/Domains';
        $providerPath = $domainsPath . '/DomainsServiceProvider.php';
        $newDomainPath = $domainsPath . '/' . $domainName;

        // 1. Create Domains folder if missing
        if (!File::exists($domainsPath)) {
            File::makeDirectory($domainsPath, 0755, true);
            $this->info("Created folder: app/Domains");
        }

        // 2. Create DomainsServiceProvider from stub if missing
        if (!File::exists($providerPath)) {
            File::put($providerPath, $this->getStub('DomainsServiceProvider.stub'));
            $this->info("Created: app/Domains/DomainsServiceProvider.php");
        } else {
            $this->comment("DomainsServiceProvider already exists.");
        }

        // 3. Create domain folder
        if (File::exists($newDomainPath)) {
            $this->error("Domain '{$domainName}' already exists at {$newDomainPath}");
            return 1;
        }

        File::makeDirectory($newDomainPath, 0755, true);
        $this->info("Created domain folder: app/Domains/{$domainName}");

        // 4. Create subfolders
        $subfolders = [
            'Console/Commands',
            'Http/Controllers',
            'Http/Requests',
            'database/migrations',
            'routes',
            'Models',
        ];

        foreach ($subfolders as $folder) {
            File::makeDirectory($newDomainPath . '/' . $folder, 0755, true);
            $this->info("Created folder: app/Domains/{$domainName}/{$folder}");
        }

        // 5. Create routes/api.php from stub (replace placeholder)
        $routesStub = $this->getStub('routes.api.stub');
        $routesContent = str_replace('{{domain}}', strtolower($domainName), $routesStub);

        File::put($newDomainPath . '/routes/api.php', $routesContent);
        $this->info("Created routes file: app/Domains/{$domainName}/routes/api.php");

        $this->info("Domain '{$domainName}' created successfully.");
        return 0;
    }

    protected function getStub(string $filename): string
    {
        $path = $this->stubPath . '/' . $filename;

        if (!File::exists($path)) {
            throw new \RuntimeException("Stub file does not exist: {$path}");
        }

        return File::get($path);
    }
}
