<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

use Livewire\Attributes\On;
use Rappasoft\LaravelLivewireTables\Tests\Models\{Breed,Owner,Pet,Species};
use Rappasoft\LaravelLivewireTables\Views\{Column, Columns\ArrayColumn, Columns\AvgColumn, Columns\BooleanColumn, Columns\ButtonGroupColumn, Columns\ColorColumn, Columns\ComponentColumn, Columns\CountColumn, Columns\DateColumn, Columns\IconColumn, Columns\ImageColumn, Columns\IncrementColumn, Columns\LinkColumn, Columns\LivewireComponentColumn, Columns\SumColumn, Columns\ViewComponentColumn, Columns\WireLinkColumn};
use Rappasoft\LaravelLivewireTables\Views\Filters\{BooleanFilter, DateFilter, DateRangeFilter, DateTimeFilter, LivewireComponentArrayFilter, LivewireComponentFilter, MultiSelectDropdownFilter, MultiSelectFilter, NumberFilter, NumberRangeFilter, SelectFilter, TextFilter};

class PetsTableEvents extends PetsTable
{
    public function mount()
    {
        $this->setShouldBeHidden();
    }

    #[On('showTable')]
    public function showTable(): void
    {
        $this->setShouldBeDisplayed();
    }

    #[On('hideTable')]
    public function hideTable()
    {
        $this->setShouldBeHidden();
    }
}
