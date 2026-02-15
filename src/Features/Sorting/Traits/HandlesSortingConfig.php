<?php

namespace Rappasoft\LaravelLivewireTables\Features\Sorting\Traits;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

trait HandlesSortingConfig
{

    protected function setSortingConfig(string $key, mixed $value): self
    {
        $this->sortingConfig[$key] = $value;

        return $this;
    }

    protected function getSortingConfig(string $key): mixed
    {
        return array_key_exists($key, $this->sortingConfig) ? $this->sortingConfig[$key] : null;
    }


}