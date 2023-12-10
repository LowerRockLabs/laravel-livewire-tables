<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

trait HasDefaultValue
{
    protected string $defaultValue = '';

    public function hasDefaultValue(): bool
    {
        return $this->defaultValue !== null && $this->defaultValue !== '';
    }

    public function getDefaultValue(): string
    {
        return $this->defaultValue;
    }

    /**
     * @return $this
     */
    public function setDefaultValue(string $defaultValue): self
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }
}
