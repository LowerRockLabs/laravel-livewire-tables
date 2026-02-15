<?php

namespace Rappasoft\LaravelLivewireTables\Features\Sorting\Traits;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

trait HandlesSortingStatus
{
    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function getSortingStatus(): bool
    {
        return $this->getSortingConfig('sortingStatus') ?? true;
    }


    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function getSingleSortingStatus(): bool
    {
        return $this->getSortingConfig('singleColumnSortingStatus') ?? true;
    }


    /**
     * Undocumented function
     *
     * @param boolean $status
     * @return self
     */
    public function setSortingStatus(bool $status): self
    {
        $this->setSortingConfig('sortingStatus', $status);

        return $this;
    }
    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function sortingIsEnabled(): bool
    {
        return $this->getSortingStatus() === true;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function sortingIsDisabled(): bool
    {
        return $this->getSortingStatus() === false;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function singleSortingIsEnabled(): bool
    {
        return $this->getSingleSortingStatus() === true;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function singleSortingIsDisabled(): bool
    {
        return $this->getSingleSortingStatus() === false;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setSortingEnabled(): self
    {
       return $this->setSortingStatus(true);
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setSortingDisabled(): self
    {
        $this->setSortingStatus(false);
        $this->clearSorts();

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param boolean $status
     * @return self
     */
    public function setSingleSortingStatus(bool $status): self
    {
        $this->setSortingConfig('singleColumnSortingStatus', $status);

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setSingleSortingEnabled(): self
    {
        return $this->setSingleSortingStatus(true);
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setSingleSortingDisabled(): self
    {
        return $this->setSingleSortingStatus(false);
    }


}