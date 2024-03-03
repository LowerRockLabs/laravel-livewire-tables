<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Browser;

use LivewireDuskTestbench\TestCase as LivewireDuskTestbenchTestCase;
use Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider;

class TestCase extends LivewireDuskTestbenchTestCase
{
    public array $packageProviders = [
        LaravelLivewireTablesServiceProvider::class,
    ];

    public function configureViewsDirectory(): string
    {
        // Resolves to 'tests/Browser/views'
        return __DIR__.'/views';
    }
}
