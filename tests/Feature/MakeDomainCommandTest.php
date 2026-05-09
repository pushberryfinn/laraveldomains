<?php

namespace Pushberryfinn\LaravelDomains\Tests\Feature;

use Illuminate\Support\Facades\File;
use Pushberryfinn\LaravelDomains\Tests\TestCase;

class MakeDomainCommandTest extends TestCase
{
    protected function tearDown(): void
    {
        $domainsPath = app_path('Domains');

        if (File::exists($domainsPath)) {
            File::deleteDirectory($domainsPath);
        }

        parent::tearDown();
    }

    public function test_it_creates_domain_folder_structure(): void
    {
        $this->artisan('domain:make', ['name' => 'Doctors'])->assertSuccessful();

        $this->assertDirectoryExists(app_path('Domains/Doctors'));
        $this->assertDirectoryExists(app_path('Domains/Doctors/Console/Commands'));
        $this->assertDirectoryExists(app_path('Domains/Doctors/Http/Controllers'));
        $this->assertDirectoryExists(app_path('Domains/Doctors/Http/Requests'));
        $this->assertDirectoryExists(app_path('Domains/Doctors/database/migrations'));
        $this->assertDirectoryExists(app_path('Domains/Doctors/routes'));
        $this->assertDirectoryExists(app_path('Domains/Doctors/Models'));
    }

    public function test_it_creates_routes_file_with_correct_prefix(): void
    {
        $this->artisan('domain:make', ['name' => 'Doctors'])->assertSuccessful();

        $routesFile = app_path('Domains/Doctors/routes/api.php');

        $this->assertFileExists($routesFile);
        $this->assertStringContainsString('doctors', File::get($routesFile));
    }

    public function test_it_creates_domains_service_provider(): void
    {
        $this->artisan('domain:make', ['name' => 'Doctors'])->assertSuccessful();

        $this->assertFileExists(app_path('Domains/DomainsServiceProvider.php'));
    }

    public function test_it_does_not_recreate_service_provider_for_second_domain(): void
    {
        $this->artisan('domain:make', ['name' => 'Doctors'])->assertSuccessful();
        $this->artisan('domain:make', ['name' => 'Patients'])->assertSuccessful();

        $this->assertFileExists(app_path('Domains/DomainsServiceProvider.php'));
        $this->assertDirectoryExists(app_path('Domains/Patients'));
    }

    public function test_it_fails_if_domain_already_exists(): void
    {
        $this->artisan('domain:make', ['name' => 'Doctors'])->assertSuccessful();
        $this->artisan('domain:make', ['name' => 'Doctors'])->assertFailed();
    }

    public function test_it_ucfirst_domain_name(): void
    {
        $this->artisan('domain:make', ['name' => 'doctors'])->assertSuccessful();

        $this->assertDirectoryExists(app_path('Domains/Doctors'));
    }
}
