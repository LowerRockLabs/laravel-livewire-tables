<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Browser;

use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Laravel\Dusk\Dusk;
use Livewire\LivewireServiceProvider;
use LivewireDuskTestbench\TestCase as LivewireDuskTestbenchTestCase;
use Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider;
use Rappasoft\LaravelLivewireTables\Tests\BaseTestCaseTrait;

class TestCase extends LivewireDuskTestbenchTestCase
{
    use BaseTestCaseTrait;

    protected function getPackageProviders($app): array
    {
        return [
            LivewireServiceProvider::class,
            LaravelLivewireTablesServiceProvider::class,
            BladeIconsServiceProvider::class,
            BladeHeroiconsServiceProvider::class,
            LaravelLivewireTablesTestServiceProvider::class,
        ];
    }

    public function setUp(): void
    {
        parent::setup();
        $this->setupTestDatabaseTables();
        $this->setupBasicTable();
        $this->setupUnpaginatedTable();

    }

    public function boot()
    {
        Dusk::selectorHtmlAttribute('tableSection');
    }

    public function configureViewsDirectory(): string
    {
        // Resolves to 'tests/Browser/views'
        return __DIR__.'/views';
    }
}
