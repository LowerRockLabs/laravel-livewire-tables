<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\SessionStorage;

trait HasFilterSessionStorage
{
    protected function storeFiltersInSessionStatus(bool $status): self
    {
        $this->setSessionStorageStatus('filters', $status);

        return $this;
    }

    public function storeFiltersInSessionEnabled(): self
    {
        return $this->storeFiltersInSessionStatus(true);
    }

    public function storeFiltersInSessionDisabled(): self
    {
        return $this->storeFiltersInSessionStatus(false);
    }

    public function shouldStoreFiltersInSession(): bool
    {
        return $this->getSessionStorageStatus('filters');
    }

    public function getFilterSessionKey(): string
    {
        return $this->getTableName().'-stored-filters';
    }

    public function storeFilterValues(): void
    {
        if ($this->shouldStoreFiltersInSession()) {
            $this->clearStoredFilterValues();
            session([$this->getFilterSessionKey() => $this->appliedFilters]);
        }
    }

    public function restoreFilterValues(): void
    {
        if (empty($this->filterComponents) || empty($this->appliedFilters)) {
            $this->filterComponents = $this->appliedFilters = $this->getStoredFilterValues();
        }
    }

    public function getStoredFilterValues(): array
    {
        if ($this->shouldStoreFiltersInSession() && session()->has($this->getFilterSessionKey())) {
            return session()->get($this->getFilterSessionKey());
        }

        return [];
    }

    public function clearStoredFilterValues(): void
    {
        if ($this->shouldStoreFiltersInSession() && session()->has($this->getFilterSessionKey())) {
            session()->forget($this->getFilterSessionKey());
        }
    }
}
