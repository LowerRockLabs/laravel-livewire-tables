<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

trait ViewComponentColumnHelpers
{
    public function getSlotCallback(): ?callable
    {
        return $this->slotCallback;
    }

    public function hasSlotCallback(): bool
    {
        return $this->slotCallback !== null;
    }

    public function getComponentView(): string
    {
        return $this->componentView;
    }

    public function hasComponentView(): bool
    {
        return isset($this->componentView);
    }

    public function hasComponentReference(): bool
    {
        return isset($this->componentReference);
    }

    public function getComponentReference(): string
    {
        return $this->componentReference;
    }
}
