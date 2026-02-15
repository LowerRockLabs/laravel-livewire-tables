<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Livewire\Attributes\Computed;

trait CustomisationsHelpers
{
    /**
     * Used to determine if a Layout Extends has been defined - used when using as a Full Page Component
     */
    public function hasExtends(): bool
    {
        return isset($this->extends);
    }

    public function getExtends(): ?string
    {
        return $this->extends;
    }

    /**
     * Used to determine if a Layout Section has been defined - used when using as a Full Page Component
     */
    public function hasSection(): bool
    {
        return isset($this->section);
    }

    public function getSection(): ?string
    {
        return $this->section;
    }

    /**
     * Used to determine if a Layout Slot has been defined - used when using as a Full Page Component
     */
    public function hasSlot(): bool
    {
        return isset($this->slot);
    }

    public function getSlot(): ?string
    {
        return $this->slot;
    }

    /**
     * Used to determine if a $layout has been defined - used when using as a Full Page Component
     */
    public function hasLayout(): bool
    {
        return isset($this->layout);
    }

    public function getLayout(): ?string
    {
        return $this->layout;
    }

    public function getCustomViewDefaultAttributes(): array
    {
        return [
            'tableComponentId' => $this->getId(),
            'tableClassName' => get_class($this),
        ];
    }

    public function getCustomViewAttributes(): array
    {
        return array_merge($this->getCustomViewDefaultAttributes(), method_exists($this, 'customViewAttributes') ? $this->customViewAttributes() : []);
    }

    #[Computed]
    public function getSimpleModalsFeatureEnabled(): bool
    {
        return (method_exists($this, 'simpleModalsAreEnabled') && method_exists($this, 'getSimpleModalsView') && method_exists($this, 'getSimpleModalsViewAttributes') && $this->simpleModalsAreEnabled());
    }

    #[Computed]
    public function getSimpleModalViewPath(): ?string
    {
        return method_exists($this, 'getSimpleModalsView') ? $this->getSimpleModalsView() : null;
    }

    #[Computed]
    public function getSimpleModalsViewAttribs(): array
    {
        return method_exists($this, 'getSimpleModalsViewAttributes') ? $this->getSimpleModalsViewAttributes() : [];
    }



}
