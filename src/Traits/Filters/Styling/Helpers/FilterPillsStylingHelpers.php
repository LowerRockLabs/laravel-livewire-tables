<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters\Styling\Helpers;

use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Views\Filter;

trait FilterPillsStylingHelpers
{
    #[Computed]
    public function showFilterPillsSection(): bool
    {
        return $this->filtersAreEnabled() && $this->filterPillsAreEnabled() && $this->hasAppliedVisibleFiltersForPills();
    }
    
    #[Computed]
    public function getFilterPillsItemAttributes(): array
    {
        return $this->filterPillsItemAttributes;
    }

    #[Computed]
    public function getFilterPillsResetFilterButtonAttributes(): array
    {
        return $this->filterPillsResetFilterButtonAttributes;
    }

    #[Computed]
    public function getFilterPillsResetAllButtonAttributes(): array
    {
        return $this->filterPillsResetAllButtonAttributes;
    }

    public function getFilterPillsStatus(): bool
    {
        return $this->filterPillsStatus;
    }

    public function filterPillsAreEnabled(): bool
    {
        return $this->getFilterPillsStatus() === true;
    }

    public function filterPillsAreDisabled(): bool
    {
        return $this->getFilterPillsStatus() === false;
    }

    public function hasAppliedVisibleFiltersForPills(): bool
    {
        return collect($this->getAppliedFiltersWithValues())
            ->map(fn ($_item, $key) => $this->getFilterByKey($key))
            ->reject(fn (Filter $filter) => $filter->isHiddenFromPills())
            ->count() > 0;
    }

}
