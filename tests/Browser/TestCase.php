<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Browser;

use LivewireDuskTestbench\TestCase as LivewireDuskTestbenchTestCase;
use Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider;
use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Livewire\LivewireServiceProvider;

class TestCase extends LivewireDuskTestbenchTestCase
{
    public array $packageProviders = [
        LivewireServiceProvider::class,
        BladeIconsServiceProvider::class,
        BladeHeroiconsServiceProvider::class,
        LaravelLivewireTablesServiceProvider::class,
    ];

    public function configureViewsDirectory(): string
    {
        // Resolves to 'tests/Browser/views'
        return __DIR__.'/views';
    }
}
