<?php

namespace Rappasoft\LaravelLivewireTables\Features\Search\Traits;

use Livewire\Attributes\{Computed, Locked};

trait HandlesSearchStatus
{
    #[Locked]
    public bool $searchStatus = true;

    #[Locked]
    public bool $searchOnlyColumns = false;

    public function getSearchStatus(): bool
    {
        return $this->searchStatus;
    }

    
    
    /**
     * Undocumented function
     * 
     * @return boolean
     */
    public function showSearchField(): bool
    {
        return $this->searchIsEnabled() && $this->searchVisibilityIsEnabled();
    }

    
    /**
     * Undocumented function
     * 
     * @return boolean
     */
    public function searchIsEnabled(): bool
    {
        return $this->getSearchStatus() === true;
    }

    public function searchIsDisabled(): bool
    {
        return $this->getSearchStatus() === false;
    }

    public function setSearchStatus(bool $status): self
    {
        $this->searchStatus = $status;

        return $this;
    }

    public function setSearchEnabled(): self
    {
        $this->setSearchStatus(true);

        return $this;
    }

    /**
     * @return $this
     */
    public function setSearchDisabled(): self
    {
        $this->search = '';

        $this->setSearchStatus(false);

        return $this;
    }


    public function getSearchOnlyColumnsStatus(): bool
    {
        return $this->searchOnlyColumns ?? false;
    }

    /**
     * @return $this
     */
    protected function setSearchOnlyColumnsStatus(bool $status): self
    {
        $this->searchOnlyColumns = $status;

        return $this;
    }

    /**
     * @return $this
     */
    protected function setSearchOnlyColumnsEnabled(): self
    {
        return $this->setSearchOnlyColumnsStatus(true);
    }

    /**
     * @return $this
     */
    protected function setSearchOnlyColumnsDisabled(): self
    {
        $this->search = '';

        return $this->setSearchOnlyColumnsStatus(false);
    }
    
    protected function shouldApplySearch(): bool
    {
        if ($this->searchIsEnabled())
        {
            if($this->getSearchOnlyColumnsStatus() && (count($this->getSearchableSelectedColumns()) == 0))
            {
                return false;
            }
            
            return true;
        }
        return false;
    }

    protected function shouldDisplaySearch(): bool
    {
        return $this->shouldApplySearch();
    }

}
