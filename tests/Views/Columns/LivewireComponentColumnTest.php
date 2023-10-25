<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Columns;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\LivewireComponentColumn;

class LivewireComponentColumnTest extends TestCase
{
    /** @test */
    public function can_set_the_column_title(): void
    {
        $column = LivewireComponentColumn::make('Name', 'name');

        $this->assertSame('Name', $column->getTitle());
    }

    /** @test */
    public function can_not_set_component_column_as_label(): void
    {
        $this->expectException(DataTableConfigurationException::class);
        $row = Pet::find(1);

        $column = LivewireComponentColumn::make('Name')->label(fn ($row, Column $column) => 'Test');
        $column->getContents($row);
    }

    /** @test */
    public function can_not_be_both_collapsible_on_mobile_and_on_tablet(): void
    {
        $this->expectException(DataTableConfigurationException::class);
        $column = LivewireComponentColumn::make('Name', 'name')->collapseOnMobile()->collapseOnTablet();
        $row = Pet::find(1);
        $column->getContents($row);

    }
}
