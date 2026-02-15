<?php

namespace Rappasoft\LaravelLivewireTables\Features\Search\Traits;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

trait HandlesSearchInput
{
    /**
    * Undocumented variable
    *
    * @var string
    */
    public string $search = '';

    /**
     * hasSearch
     *
     * @return boolean
     *     #[Computed]
     */
    public function hasSearch(): bool
    {
        return $this->search != '';
    }

    /**
     * getSearch
     *  #[Computed]
     * @return string
     */
    public function getSearch(): string
    {
        if ($this->shouldTrimSearchString() && $this->search != trim($this->search)) {
            $this->search = trim($this->search);
        }

        return $this->search ?? '';
    }

    /**
     * Search the search query from the table array
     *
     * @return void
     */
     public function clearSearch(): void
    {
        $this->search = '';
    }

    /**
     * Undocumented function
     *
     * @param string $query
     * @return self
     */
    public function setSearch(string $query): self
    {
        if ($this->shouldTrimSearchString()) {
            $this->search = trim($query);
        } else {
            $this->search = $query;
        }

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param string|null $value
     * @return void
     */
    public function updatedSearch(string|null $value): void
    {

        if(!$this->reloading)
        {
            if ($this->shouldTrimSearchString() && $this->search != trim($value)) {
                $this->search = $value = trim($value);
            }

            $this->resetComputedPage();

            // Clear bulk actions on search - if enabled
            if ($this->getClearSelectedOnSearch()) {
                $this->clearSelected();
                $this->setSelectAllDisabled();
            }

            if (is_null($value) || $value === '') {
                $this->clearSearch();
            }
        }
    }

}