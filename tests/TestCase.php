<?php

namespace Rappasoft\LaravelLivewireTables\Tests;

use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\DB;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider;
use Rappasoft\LaravelLivewireTables\Tests\BaseTestCaseTrait;
use Rappasoft\LaravelLivewireTables\Tests\Livewire\{PetsTable,PetsTableUnpaginated};
use Rappasoft\LaravelLivewireTables\Tests\Models\{Breed,Pet,Species,Veterinary};

class TestCase extends Orchestra
{
    use BaseTestCaseTrait;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->setupTestDatabaseTables();
        $this->setupBasicTable();
        $this->setupUnpaginatedTable();

    }
}
