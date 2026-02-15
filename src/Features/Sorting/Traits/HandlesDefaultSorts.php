<?php

namespace Rappasoft\LaravelLivewireTables\Features\Sorting\Traits;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

trait HandlesDefaultSorts
{
    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function getDefaultSortColumn(): ?string
    {
        return $this->getSortingConfig('defaultSortColumn') ?? null;
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getDefaultSortDirection(): string
    {
        return $this->getSortingConfig('defaultSortDirection')  ?? 'asc';
    }


    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function hasDefaultSort(): bool
    {
        return $this->getDefaultSortColumn() !== null;
    }

    
    /**
     * Undocumented function
     *
     * @return void
     */
    protected function setupDefaultSorting(): void
    {
        if ($this->sortingIsEnabled() && $this->hasDefaultSort() && ! $this->hasSorts()) {
            $this->setSort($this->getDefaultSortColumn(), $this->getDefaultSortDirection());
        }
    }


    /**
     * Undocumented function
     *
     * @param string $field
     * @param string $direction
     * @return self
     */
    public function setDefaultSort(string $field, string $direction = 'asc'): self
    {
        $this->setSortingConfig('defaultSortColumn', $field);
        $this->setSortingConfig('defaultSortDirection', $direction);

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function removeDefaultSort(): self
    {
        $this->setSortingConfig('defaultSortColumn', null);
        $this->setSortingConfig('defaultSortDirection', 'asc');

        return $this;
    }


}
