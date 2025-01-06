<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Tests\Models\{Breed,Owner,Pet,Species};
use Rappasoft\LaravelLivewireTables\Views\{Column, Columns\ArrayColumn, Columns\AvgColumn, Columns\BooleanColumn, Columns\ButtonGroupColumn, Columns\ColorColumn, Columns\ComponentColumn, Columns\CountColumn, Columns\DateColumn, Columns\IconColumn, Columns\ImageColumn, Columns\IncrementColumn, Columns\LinkColumn, Columns\LivewireComponentColumn, Columns\SumColumn, Columns\ViewComponentColumn, Columns\WireLinkColumn};
use Rappasoft\LaravelLivewireTables\Views\Filters\{BooleanFilter, DateFilter, DateRangeFilter, DateTimeFilter, LivewireComponentArrayFilter, LivewireComponentFilter, MultiSelectDropdownFilter, MultiSelectFilter, NumberFilter, NumberRangeFilter, SelectFilter, TextFilter};

class SpeciesTable extends DataTableComponent
{
    public $model = Species::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function resetSearchToDefault()
    {
        $this->searchFilterBlur = null;
        $this->searchFilterDebounce = null;
        $this->searchFilterDefer = null;
        $this->searchFilterLazy = null;
        $this->searchFilterLive = null;
        $this->searchFilterThrottle = null;
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->setSortingPillTitle('Key')
                ->setSortingPillDirections('0-9', '9-0'),
            Column::make('Name')
                ->sortable()
                ->searchable(),
            AvgColumn::make('Average Age')
                ->setDataSource('pets', 'age'),
            CountColumn::make('Number of Pets')
                ->setDataSource('pets'),
            SumColumn::make('Total Age')
                ->setDataSource('pets', 'age'),

        ];
    }
}
