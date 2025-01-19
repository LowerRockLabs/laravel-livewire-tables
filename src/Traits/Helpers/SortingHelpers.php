<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

trait SortingHelpers
{
    public function getSortingStatus(): bool
    {
        return $this->sortingStatus;
    }

    public function getSingleSortingStatus(): bool
    {
        return $this->singleColumnSortingStatus;
    }

    public function getSorts(): array
    {
        foreach ($this->sorts as $column => $direction) {
            if (is_array($direction)) {
                foreach ($direction as $colAppend => $actualDirection) {
                    $this->sorts[$column.'.'.$colAppend] = $actualDirection;
                    unset($this->sorts[$column]);
                }
            }
        }

        return $this->sorts;
    }

    public function getSort(string $field): ?string
    {
        return $this->sorts[$field] ?? null;
    }

    public function hasSorts(): bool
    {
        return count($this->getSorts()) > 0;
    }

    public function hasSort(string $field): bool
    {
        return $this->getSort($field) !== null;
    }

    public function isSortAsc(string $field): bool
    {
        return $this->getSort($field) === 'asc';
    }

    public function isSortDesc(string $field): bool
    {
        return $this->getSort($field) === 'desc';
    }

    #[Computed]
    public function sortingIsEnabled(): bool
    {
        return $this->getSortingStatus() === true;
    }

    #[Computed]
    public function sortingIsDisabled(): bool
    {
        return $this->getSortingStatus() === false;
    }

    public function singleSortingIsEnabled(): bool
    {
        return $this->getSingleSortingStatus() === true;
    }

    public function singleSortingIsDisabled(): bool
    {
        return $this->getSingleSortingStatus() === false;
    }

    public function hasDefaultSort(): bool
    {
        return $this->getDefaultSortColumn() !== null;
    }

    public function getDefaultSortColumn(): ?string
    {
        return $this->defaultSortColumn;
    }

    public function getDefaultSortDirection(): string
    {
        return $this->defaultSortDirection;
    }

    public function getSortingPillsStatus(): bool
    {
        return $this->sortingPillsStatus;
    }

    public function sortingPillsAreEnabled(): bool
    {
        return $this->getSortingPillsStatus() === true;
    }

    public function sortingPillsAreDisabled(): bool
    {
        return $this->getSortingPillsStatus() === false;
    }

    #[Computed]
    public function getDefaultSortingLabelAsc(): string
    {
        return $this->defaultSortingLabelAsc;
    }

    #[Computed]
    public function getDefaultSortingLabelDesc(): string
    {
        return $this->defaultSortingLabelDesc;
    }

    #[Computed]
    public function showSortPillsSection(): bool
    {
        return $this->sortingIsEnabled() && $this->sortingPillsAreEnabled() && $this->hasSorts();
    }

    #[Computed]
    public function getSortedColumnsForPills(): array
    {
        $activeSorts = $this->getSorts();

        return $this->getColumnsForColumnSortPills($activeSorts);

    }
}
