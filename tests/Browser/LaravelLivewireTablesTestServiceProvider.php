<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Browser;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Tests\Livewire\PetsTable;

class LaravelLivewireTablesTestServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Livewire::component('pets-table', PetsTable::class);
    }
}
