<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core\Configuration;

trait DefaultValueConfiguration
{
    /**
     * @return $this
     */
    public function setDefaultValue(string $defaultValue): self
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }

    /**
     * Sets a Default Value via the Filter Component
     *
     * @param  mixed  $value
     */
    public function setFilterDefaultValue($value): self
    {
        $this->setDefaultValue($value);

        return $this;
    }
}
