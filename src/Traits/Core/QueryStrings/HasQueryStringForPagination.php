<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\QueryStrings;

trait HasQueryStringForPagination
{
    protected function queryStringHasQueryStringForPagination(): array
    {
        return (($this->queryStringIsEnabled() || $this->queryStringForPaginationEnabled()) && $this->paginationIsEnabled()) ?
        [
            'perPage' => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAliasForPagination()],
        ] : [];

    }

    protected function setupQueryStringStatusForPagination(): void
    {
        if (! $this->hasQueryStringStatusForPagination()) {
            $this->setQueryStringForPaginationEnabled();
        }
    }

    public function hasQueryStringStatusForPagination(): bool
    {
        return $this->hasQueryStringConfigStatus('perPage');
    }

    public function getQueryStringStatusForPagination(): bool
    {
        return $this->getQueryStringConfigStatus('perPage');
    }

    public function queryStringForPaginationEnabled(): bool
    {
        $this->setupQueryStringStatusForPagination();

        return $this->getQueryStringStatusForPagination() && $this->paginationIsEnabled();
    }

    public function setQueryStringStatusForPagination(bool $status): self
    {
        return $this->setQueryStringConfigStatus('perPage', $status);
    }

    public function setQueryStringForPaginationEnabled(): self
    {
        return $this->setQueryStringStatusForPagination(true);
    }

    public function setQueryStringForPaginationDisabled(): self
    {
        return $this->setQueryStringStatusForPagination(false);
    }

    public function hasQueryStringAliasForPagination(): bool
    {
        return $this->hasQueryStringConfigAlias('perPage');
    }

    public function getQueryStringAliasForPagination(): string
    {
        return $this->getQueryStringConfigAlias('perPage');
    }

    public function setQueryStringAliasForPagination(string $alias): self
    {
        return $this->setQueryStringConfigAlias('perPage', $alias);
    }
}
