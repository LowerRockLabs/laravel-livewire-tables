<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters\Styling\Configuration;

trait FilterPillsStylingConfiguration
{

    public function setFilterPillsStatus(bool $status): self
    {
        $this->filterPillsStatus = $status;

        return $this;
    }

    public function setFilterPillsEnabled(): self
    {
        $this->setFilterPillsStatus(true);

        return $this;
    }

    public function setFilterPillsDisabled(): self
    {
        $this->setFilterPillsStatus(false);

        return $this;
    }

    public function setFilterPillsItemAttributes(array $attributes = []): self
    {
        $this->filterPillsItemAttributes = [...$this->filterPillsItemAttributes, ...$attributes];

        return $this;
    }

    public function setFilterPillsResetFilterButtonAttributes(array $attributes = []): self
    {
        $this->filterPillsResetFilterButtonAttributes = [...$this->filterPillsResetFilterButtonAttributes, ...$attributes];

        return $this;
    }

    public function setFilterPillsResetAllButtonAttributes(array $attributes = []): self
    {
        $this->filterPillsResetAllButtonAttributes = [...$this->filterPillsResetAllButtonAttributes, ...$attributes];

        return $this;
    }
}
