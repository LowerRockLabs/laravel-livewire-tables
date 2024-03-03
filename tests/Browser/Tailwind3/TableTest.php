<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Browser\Tailwind3;

use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Tests\Browser\TestCase;
use Rappasoft\LaravelLivewireTables\Tests\Unit\Http\Livewire\PetsTable;

class TableTest extends TestCase
{
    /** @test */
    public function counter_component_can_be_used_in_another_component()
    {
        Livewire::visit(PetsTable::class)
            ->assertSeeAnythingIn('@component-view')
            ->assertSeeIn('@component-view', 0);
    }
}
