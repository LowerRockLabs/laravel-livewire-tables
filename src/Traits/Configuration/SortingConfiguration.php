<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

use Livewire\Attributes\On;

trait SortingConfiguration
{
    protected function setupDefaultSorting(): void
    {
        if ($this->sortingIsEnabled() && $this->hasDefaultSort() && ! $this->hasSorts()) {
            $this->setSort($this->getDefaultSortColumn(), $this->getDefaultSortDirection());
        }
    }

    public function setSortingStatus(bool $status): self
    {
        $this->sortingStatus = $status;

        return $this;
    }

    public function setSortingEnabled(): self
    {
        $this->setSortingStatus(true);

        return $this;
    }

    public function setSortingDisabled(): self
    {
        $this->setSortingStatus(false);
        $this->sorts = [];

        return $this;
    }

    public function setSingleSortingStatus(bool $status): self
    {
        $this->singleColumnSortingStatus = $status;

        return $this;
    }

    public function setSingleSortingEnabled(): self
    {
        $this->setSingleSortingStatus(true);

        return $this;
    }

    public function setSingleSortingDisabled(): self
    {
        $this->setSingleSortingStatus(false);

        return $this;
    }

    public function setDefaultSort(string $field, string $direction = 'asc'): self
    {
        $this->defaultSortColumn = $field;
        $this->defaultSortDirection = $direction;

        return $this;
    }

    public function removeDefaultSort(): self
    {
        $this->defaultSortColumn = null;
        $this->defaultSortDirection = 'asc';

        return $this;
    }

    public function setSortingPillsStatus(bool $status): self
    {
        $this->sortingPillsStatus = $status;

        return $this;
    }

    public function setSortingPillsEnabled(): self
    {
        $this->setSortingPillsStatus(true);

        return $this;
    }

    public function setSortingPillsDisabled(): self
    {
        $this->setSortingPillsStatus(false);

        return $this;
    }

    public function setDefaultSortingLabels(string $asc, string $desc): self
    {
        $this->defaultSortingLabelAsc = $asc;
        $this->defaultSortingLabelDesc = $desc;

        return $this;
    }

    /**
     * @param  array<mixed>  $sorts
     * @return array<mixed>
     */
    public function setSorts(array $sorts = []): array
    {

        return $this->sorts = collect($sorts)
            ->reject(fn ($dir, $column) => ! in_array($column, $this->getSortableColumns()->toArray(), true))
            ->toArray();
    }

    #[On('setSort')]
    #[On('set-sort')]
    public function setSort(string $field, string $direction): string
    {
        return $this->sorts[$field] = $direction;
    }

    public function setSortAsc(string $field): string
    {
        return $this->setSort($field, 'asc');
    }

    public function setSortDesc(string $field): string
    {
        return $this->setSort($field, 'desc');
    }

    /**
     * Clear the sorts array
     */
    #[On('clearSorts')]
    #[On('clearsorts')]
    public function clearSorts(): void
    {
        $this->sorts = [];
    }

    public function clearSort(string $field): void
    {
        unset($this->sorts[$field]);
    }

}
