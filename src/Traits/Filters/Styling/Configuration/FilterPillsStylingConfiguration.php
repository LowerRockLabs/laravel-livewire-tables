<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters\Styling\Configuration;

trait FilterPillsStylingConfiguration
{
    protected function setShowFilterPillsWhileLoading(bool $status): self
    {
        $this->showFilterPillsWhileLoading = $status;

        return $this;
    }

    protected function showFilterPillsWhileLoadingEnabled(): self
    {
        return $this->setShowFilterPillsWhileLoading(true);
    }

    protected function showFilterPillsWhileLoadingDisabled(): self
    {
        return $this->setShowFilterPillsWhileLoading(false);
    }

    protected function setFilterPillsItemAttributes(array $attributes = []): self
    {
        return $this->mergeCustomAttributes(propertyName: 'filterPillsItemAttributes', customAttributes: $attributes);
    }

    protected function setFilterPillsResetFilterButtonAttributes(array $attributes = []): self
    {
        return $this->mergeCustomAttributes(propertyName: 'filterPillsResetFilterButtonAttributes', customAttributes: $attributes);
    }

    protected function setFilterPillsResetAllButtonAttributes(array $attributes = []): self
    {
        return $this->mergeCustomAttributes(propertyName: 'filterPillsResetAllButtonAttributes', customAttributes: $attributes);
    }
}
