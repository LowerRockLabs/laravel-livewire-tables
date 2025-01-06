<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Tests\Models\{Breed,Owner,Pet,Species};
use Rappasoft\LaravelLivewireTables\Views\Filters\{BooleanFilter, DateFilter, DateRangeFilter, DateTimeFilter, LivewireComponentArrayFilter, LivewireComponentFilter, MultiSelectDropdownFilter, MultiSelectFilter, NumberFilter, NumberRangeFilter, SelectFilter, TextFilter};
use Rappasoft\LaravelLivewireTables\Views\{Column, Columns\ArrayColumn, Columns\AvgColumn, Columns\BooleanColumn, Columns\ButtonGroupColumn, Columns\ColorColumn, Columns\ComponentColumn, Columns\CountColumn, Columns\DateColumn, Columns\IconColumn, Columns\ImageColumn, Columns\IncrementColumn, Columns\LinkColumn, Columns\LivewireComponentColumn, Columns\SumColumn, Columns\ViewComponentColumn, Columns\WireLinkColumn};

class PetsTableCustomFilters extends PetsTable
{
    public function filters(): array
    {
        return [
            MultiSelectFilter::make('Breed')
                ->options(
                    Breed::query()
                        ->orderBy('name')
                        ->get()
                        ->keyBy('id')
                        ->map(fn ($breed) => $breed->name)
                        ->toArray()
                )
                ->filter(function (Builder $builder, array $values) {
                    return $builder->whereIn('breed_id', $values);
                }),
            MultiSelectDropdownFilter::make('Species')
                ->options(
                    Species::query()
                        ->orderBy('name')
                        ->get()
                        ->keyBy('id')
                        ->map(fn ($species) => $species->name)
                        ->toArray()
                )
                ->filter(function (Builder $builder, array $values) {
                    return $builder->whereIn('species_id', $values);
                })
                ->setPillsSeparator('<br />'),

        ];
    }
}
