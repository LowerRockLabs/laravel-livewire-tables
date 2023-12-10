<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core\Helpers;

trait DefaultValueHelpers
{
    public function hasDefaultValue(): bool
    {
        return $this->defaultValue !== null && $this->defaultValue !== '';
    }

    public function getDefaultValue(): string
    {
        return $this->defaultValue;
    }

    /**
     * Determines if the Filter has a Default Value via the Component
     */
    public function hasFilterDefaultValue(): bool
    {
        return ! is_null($this->getDefaultValue());
    }

}