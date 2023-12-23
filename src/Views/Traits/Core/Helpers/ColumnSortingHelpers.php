<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core\Helpers;

trait ColumnSortingHelpers
{
    public function getSortCallback(): ?callable
    {
        return $this->sortCallback;
    }

    public function isSortable(): bool
    {
        return $this->hasField() && $this->sortable === true;
    }

    public function hasSortCallback(): bool
    {
        return $this->sortCallback !== null;
    }

    public function getSortingPillTitle(): string
    {
        if ($this->hasCustomSortingPillTitle()) {
            return $this->getCustomSortingPillTitle();
        }

        return $this->getTitle();
    }

    public function getCustomSortingPillTitle(): ?string
    {
        return $this->sortingPillTitle;
    }

    public function hasCustomSortingPillTitle(): bool
    {
        return $this->getCustomSortingPillTitle() !== null;
    }

    public function hasCustomSortingPillDirections(): bool
    {
        return $this->sortingPillDirectionAsc !== null && $this->sortingPillDirectionDesc !== null;
    }

    public function getCustomSortingPillDirections(string $direction): string
    {
        if ($direction === 'asc') {
            return $this->sortingPillDirectionAsc;
        }

        if ($direction === 'desc') {
            return $this->sortingPillDirectionDesc;
        }

        return __('N/A');
    }

    public function getSortingPillDirection(DataTableComponent $component, string $direction): string
    {
        if ($this->hasCustomSortingPillDirections()) {
            return $this->getCustomSortingPillDirections($direction);
        }

        return $direction === 'asc' ? $component->getDefaultSortingLabelAsc() : $component->getDefaultSortingLabelDesc();
    }
}
