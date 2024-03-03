<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Browser\Tailwind3;

use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Tests\Browser\TestCase;

class TableTest extends TestCase
{
    /** @test */
    public function check_striping_classes()
    {
        Livewire::visit(Table::class)
            ->waitForLivewireToLoad()
                //->screenshot('test2')
            ->assertHasClass('tr[rowpk="2"]', 'bg-gray-50')
            ->assertHasClass('tr[rowpk="1"]', 'dark:bg-gray-700');
    }

    /** @test */
    public function check_striping_classes_has_class()
    {
        Livewire::visit(Table::class)
            ->waitForLivewireToLoad()
            ->assertHasClass('tr[rowpk="2"]', 'bg-gray-50')
            ->assertHasClass('tr[rowpk="1"]', 'bg-white')
            ->assertHasClass('tr[rowpk="1"]', 'dark:bg-gray-700')
            ->assertHasClass('tr[rowpk="2"]', 'dark:bg-gray-800')
            ->screenshot('test-has-class');
    }

    /** @test */
    public function check_striping_classes_class_missing()
    {
        Livewire::visit(Table::class)
            ->waitForLivewireToLoad()
                //->screenshot('test-class-missing')
            ->assertHasClass('tr[rowpk="2"]', 'bg-gray-50')
            ->assertClassMissing('tr[rowpk="1"]', 'bg-gray-50')
            ->assertClassMissing('tr[rowpk="2"]', 'bg-white');
    }

    /** @test */
    public function check_striping_classes_has_all_classes()
    {
        Livewire::visit(Table::class)
            ->waitForLivewireToLoad()
                //->screenshot('has_all_classes')
            ->assertHasClass('tr[rowpk="2"]', 'bg-gray-50')
            ->assertHasAllClasses('tr[rowpk="2"]', ['bg-gray-50', 'dark:bg-gray-800', 'dark:text-white', 'rappasoft-striped-row'])
            ->assertHasAllClasses('tr[rowpk="1"]', ['bg-white', 'dark:bg-gray-700', 'dark:text-white']);
    }

    /** @test */
    public function check_striping_classes_missing_all_classes()
    {
        Livewire::visit(Table::class)
            ->waitForLivewireToLoad()
                //->screenshot('missing_all_classes')
            ->assertHasClass('tr[rowpk="2"]', 'bg-gray-50')
            ->assertMissingAllClasses('tr[rowpk="1"]', ['bg-gray-50', 'dark:bg-gray-800'])
            ->assertMissingAllClasses('tr[rowpk="2"]', ['bg-white', 'dark:bg-gray-700']);
    }

    /** @test */
    public function check_striping_classes_has_only_classes()
    {
        Livewire::visit(Table::class)
            ->waitForLivewireToLoad()
            ->screenshot('classes_has_only_classes')
            ->storeSource('classes_has_only_classes')
            ->assertHasClass('tr[rowpk="2"]', 'bg-gray-50')
            ->assertHasOnlyClasses('tr[rowpk="2"]', ['bg-gray-50', 'dark:bg-gray-800', 'dark:text-white', 'rappasoft-striped-row'])
            ->assertHasOnlyClasses('tr[rowpk="1"]', ['bg-white', 'dark:bg-gray-700', 'dark:text-white', 'rappasoft-striped-row']);
    }
}
