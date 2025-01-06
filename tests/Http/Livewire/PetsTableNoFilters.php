<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

use Rappasoft\LaravelLivewireTables\Tests\Models\{Breed,Owner,Pet,Species};
use Rappasoft\LaravelLivewireTables\Views\{Column, Columns\ArrayColumn, Columns\AvgColumn, Columns\BooleanColumn, Columns\ButtonGroupColumn, Columns\ColorColumn, Columns\ComponentColumn, Columns\CountColumn, Columns\DateColumn, Columns\IconColumn, Columns\ImageColumn, Columns\IncrementColumn, Columns\LinkColumn, Columns\LivewireComponentColumn, Columns\SumColumn, Columns\ViewComponentColumn, Columns\WireLinkColumn};
use Rappasoft\LaravelLivewireTables\Views\Filters\{BooleanFilter, DateFilter, DateRangeFilter, DateTimeFilter, LivewireComponentArrayFilter, LivewireComponentFilter, MultiSelectDropdownFilter, MultiSelectFilter, NumberFilter, NumberRangeFilter, SelectFilter, TextFilter};

class PetsTableNoFilters extends PetsTable
{
    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->setSortingPillTitle('Key')
                ->setSortingPillDirections('0-9', '9-0'),
            Column::make('Sort')
                ->sortable(),
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Age'),
            Column::make('Breed', 'breed.name')
                ->sortable(),
            Column::make('Other')
                ->label(function ($row, Column $column) {
                    return 'Other';
                }),
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }
}
