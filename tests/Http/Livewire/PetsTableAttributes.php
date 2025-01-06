<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

use Rappasoft\LaravelLivewireTables\Tests\Models\{Breed,Owner,Pet,Species};
use Rappasoft\LaravelLivewireTables\Views\{Column, Columns\ArrayColumn, Columns\AvgColumn, Columns\BooleanColumn, Columns\ButtonGroupColumn, Columns\ColorColumn, Columns\ComponentColumn, Columns\CountColumn, Columns\DateColumn, Columns\IconColumn, Columns\ImageColumn, Columns\IncrementColumn, Columns\LinkColumn, Columns\LivewireComponentColumn, Columns\SumColumn, Columns\ViewComponentColumn, Columns\WireLinkColumn};
use Rappasoft\LaravelLivewireTables\Views\Filters\{BooleanFilter, DateFilter, DateRangeFilter, DateTimeFilter, LivewireComponentArrayFilter, LivewireComponentFilter, MultiSelectDropdownFilter, MultiSelectFilter, NumberFilter, NumberRangeFilter, SelectFilter, TextFilter};

class PetsTableAttributes extends PetsTable
{
    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTrAttributes(function ($row, $index) {
                if ($index === 0) {
                    return [
                        'testTrAttribute' => 'testTrAttributeValueForTestSuiteIndex0',
                        'default' => false,
                    ];
                }
                if ($index === 1) {
                    return [
                        'testTrAttribute' => 'testTrAttributeValueForTestSuiteIndex1',
                        'default' => false,
                    ];
                }
                if ($index === 500) {
                    return [
                        'testTrAttribute' => 'testTrAttributeValueForTestSuiteNotSeen',
                        'default' => false,
                    ];
                }

                return [];
            });

    }
}
