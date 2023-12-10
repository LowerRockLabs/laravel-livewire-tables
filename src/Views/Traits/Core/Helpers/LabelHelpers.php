<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core\Helpers;

/**
 * Not to be confused with label() columns
 */
trait LabelHelpers
{
    /**
     * Returns whether this has a custom label blade
     */
    public function hasCustomLabel(): bool
    {
        return ! is_null($this->customLabel);
    }

    /**
     * Returns the path to the custom label blade
     */
    public function getCustomLabel(): string
    {
        return $this->customLabel ?? '';
    }

    /**
     * Returns whether this has custom label attributes
     */
    public function hasCustomLabelAttributes(): bool
    {
        return $this->getCustomLabelAttributes() != ['default' => true] && $this->getCustomLabelAttributes() != ['default' => false];
    }

    /**
     * Returns the custom label attributes
     */
    public function getCustomLabelAttributes(): array
    {
        return [...['default' => true], ...$this->customLabelAttributes];
    }

    /**
     * Deprecated but in use
     * Returns the filter custom label attributes
     */
    public function getFilterLabelAttributes(): array
    {
        return $this->getCustomLabelAttributes();
    }

    /**
     * Deprecated but in use
     * Returns whether the filter has custom label attributes
     */
    public function hasFilterLabelAttributes(): bool
    {
        return $this->getCustomLabelAttributes() != ['default' => true] && $this->getCustomLabelAttributes() != ['default' => false];
    }

    /**
     * Deprecated but in use
     * Returns whether the filter has a custom label blade
     */
    public function hasCustomFilterLabel(): bool
    {
        return ! is_null($this->customLabel);
    }

    /**
     * Deprecated but in use
     * Returns the path to the custom filter label blade
     */
    public function getCustomFilterLabel(): string
    {
        return $this->customLabel ?? '';
    }
}
